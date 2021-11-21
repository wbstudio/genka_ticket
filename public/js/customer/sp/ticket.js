$(window).load(function(){
    openWebcam(event);
});

function scan(e) {
    const files = e.target.files || e.dataTransfer.files;
    if (!files.length) return;
    const file = files[0];
    const fileReader = new FileReader();
    fileReader.onload = function(theFile) {
      const image = new Image();
      image.onload = function() {
        // create a canvas in memory:
        const canvas = document.createElement('canvas');
        // canvas needs enough width and height to draw the qrcode image:
        canvas.width = this.width;
        canvas.height = this.height;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(image, 0, 0);
        const imageData = ctx.getImageData(0, 0, this.width, this.height);
        const data = jsQR(imageData.data, imageData.width, imageData.height);
        if (data) {
          const message = data.data;
          console.log("message:", message); // message: "あいうえお"
        }
      };
      const dataURL = theFile.target.result;
      if (!dataURL || !dataURL.startsWith("data:image/")) {
        alert("[ERROR] 読み取りできませんでした。");
      }
      image.src = dataURL;
    };
    fileReader.readAsDataURL(file);
  }

  // Webカメラの起動＆ストリーム読込開始処理
function openWebcam(e) {
    // related elements:
    const $root = $("#pane-webcam");
    const canvas = $root.find("[name=canvas]")[0];
    const video = $root.find("[name=video]").show()[0];
    const ctx = canvas.getContext('2d');
    // open webcam device
    navigator.mediaDevices.getUserMedia({
      audio: false,
      video: true,
    }).then(function(stream) {
      video.srcObject = stream;
      video.onloadedmetadata = function(e) {
        // video.play();
        self.snapshot({ video, canvas, ctx, });
      };
    }).catch(function(e) {
      alert("ERROR: Webカメラの起動に失敗しました: " + e.message);
    });
  }
  
  // 読み込んだストリームからスナップショットを取得＆解析
  function snapshot({ video, canvas, ctx, }) {
    const self = this;
    if (!video.srcObject.active) return;
    // Draws current image from the video element into the canvas
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const data = jsQR(imageData.data, imageData.width, imageData.height);
    if (!data) {
        // QRコードのスナップショット画像を解析できるまでリトライ・・・
      setTimeout(() => {
        return self.snapshot({ video, canvas, ctx, }); // retry ...
      }, 800); // NOTE: ここを小さくしすぎるとCPUに負荷が掛かります
    } else {
        // 解析成功！
      if (data) {
        const message = data.data; // QRコードからメッセージを取得
        console.log("message:", message);
        //gen-chike/shop/5/service/3/ticket/2
        var res = message.split('/');
        var customeId = document.getElementById("customer_id").value;
        //testCode
        // var customeId = 5;
        //読み取りのres[0]とかではじかないといけない？
        console.log(res);
        console.log(customeId);
        insertAjax(res[2],res[4],res[6],customeId);
      }
      // Webカメラの停止
      self.stopWebcam({ video, canvas, ctx, });
    }
  }
  
  // Webカメラの停止処理
  function stopWebcam({ video, canvas, ctx }) {
    const self = this;
    if (!video) {
      video = $("[name=video]")[0];
    }
    video.pause();
    stream = video.srcObject;
    // self.stream.getVideoTracks()[0].stop();
    stream.getTracks().forEach(track => track.stop());
    video.src = "";
    $(video).hide();
  }


function insertAjax(shop_id,service_id,ticket_count,customer_id){
    $.ajax({
        type: "get", //HTTP通信の種類
        url: "/ajax/ticket_use_insert/shop/" + shop_id + "/service/" + service_id + "/ticket/" + ticket_count + "/customer/" + customer_id,
        dataType: "json",
    }).done((response) => {
        console.log(response);
        if(response.result){
            //成功→thanksへリダイレクト
            window.location.href = "/customer/ticket/thanks";
        }else if(response.status == 0){
            //失敗(枚数足りない)→ticket購入ページへのリンクのあるページへリダイレクト
            window.location.href = "/customer/ticket/shortage";
        }else{
            //失敗(パラメータ不正)→alertを出して同じページへリダイレクト
            alert("パラメーター不正です。再度読み取りをお願いします。");
            location.reload();
        }
    }).fail((error) => {
        console.log(error.statusText);
    });
}