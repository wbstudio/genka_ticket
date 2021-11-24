<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use \App\Libraries\LineClass;
use \App\Models\Customer;
use Illuminate\Support\Facades\Log;

class EntranceController extends Controller
{
    //
    public function index()
    {
        $commonController = new CommonController;
        $displayType = $commonController->selectBrowser();
        return view('Entrance.' . USER_AGENT . '.index');
    }

    public function regist()
    {
        $commonController = new CommonController;
        $displayType = $commonController->selectBrowser();

        $lineUserDetail = session('line.user');
        if (!is_null($lineUserDetail) && !is_null($lineUserDetail['line_user_id'])) {
            $dispData = [
                'userData' => $lineUserDetail
            ];
            return view('Entrance.' . USER_AGENT . '.regist', $dispData);
        }
        $lineClass = new LineClass;
        return $lineClass->authorize(env('APP_URL') . '/entrance/linelink');
    }

    /**
     * LINE連携画面のLINE認証コールバック
     */
    public function lineLink(Request $request)
    {
        $lineClass = new LineClass;

        try {
            // エラーの場合
            if (isset($request['error'])) {
                Log::debug('ERROR :--------------------------------------------------------');
                Log::debug($request['error_description']);
                throw new \Exception("ERROR :AUTH_REDIRECT");
            }

            // 同一チェックが異なる場合
            $postState = session('line.state');
            if ($postState !== $request['state']) {
                Log::debug('ERROR :--------------------------------------------------------');
                throw new \Exception("ERROR :DIFFERENT_STATE");
            }

            // IDトークン取得
            $idToken = $lineClass->getIdToken($request['code']);
            if (!$idToken) {
                throw new \Exception("ERROR :ID_TOKEN");
            }

            // LINEユーザーID取得
            $lineUserDetail = $lineClass->getLineUserDetail($idToken);
            if (!$lineUserDetail['line_user_id']) {
                throw new \Exception("ERROR :LINE_USER_ID");
            }

            // LINE連携存在チェック
            $mbCustomer = new Customer();
            $customer = $mbCustomer
                ->where([
                    'line_user_key' => $lineUserDetail['line_user_id'],
                    'delete_flag' => 0
                ])
                ->first();
            if (!is_null($customer)) {
                // 既に登録されている旨のエラーメッセージ
                return redirect('customer');
            }

            // LINEユーザー情報をセッションに保存
            session(['line.user' => $lineUserDetail]);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            // $this->Flash->error('エラーが発生しました。何度も続く場合は、お問い合わせください。');
            return redirect('/');
        }

        // 入力画面にリダイレクト
        return redirect('customer/regist');
    }

    /**
     * ユーザー登録処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers',
        ]);

        $cunstomerData = $request->all();
        $cunstomerData['line_user_key'] = session('line.user.line_user_id');
        $cunstomerData['ticket'] = 0;

        Customer::create($cunstomerData);

        session()->forget('line.user');

        return redirect('customer/home');
    }
}
