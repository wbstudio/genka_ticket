<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use \App\Libraries\LineClass;
use \App\Models\Customer;

class EntranceController extends Controller
{
    //
    public function index () 
    {
        $commonController = new CommonController;
        $displayType = $commonController->selectBrowser();
        return view('Entrance.'. USER_AGENT .'.index');
    }

    public function create() 
    {
        $lineUserDetail = session('line.user');
        if (!is_null($lineUserDetail)) {
            $dispData = [
                'userData' => $lineUserDetail
            ];    
            return view('Entrance.'. USER_AGENT .'.create', $dispData);
        }
        $lineClass = new LineClass;
        return $lineClass->authorize(env('APP_URL').'/customer/linelink');
    }
    
    /**
     * LINE連携画面のLINE認証コールバック
     */
    public function lineLink()
    {
        $getParam = $this->request->getQuery();
        $lineClass = new LineClass;

        try {
            // エラーの場合
            if (isset($getParam['error'])) {
                Log::debug('ERROR :--------------------------------------------------------', 'line_login_error');
                Log::debug($getParam['error_description'], 'line_login_error');
                throw new \Exception("ERROR :AUTH_REDIRECT");
            }

            // 同一チェックが異なる場合
            $postState = session('line.state');
            if ($postState !== $getParam['state']) {
                Log::debug('ERROR :--------------------------------------------------------', 'line_login_error');
                throw new \Exception("ERROR :DIFFERENT_STATE");
            }

            // IDトークン取得
            $idToken = $lineClass->getIdToken($getParam['code']);
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
                    'line_user_id' => $lineUserDetail['line_user_id'],
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
            Log::debug($e->getMessage(), 'line_login_error');
            // $this->Flash->error('エラーが発生しました。何度も続く場合は、お問い合わせください。');
            return redirect('customer');
        }

        // 入力画面にリダイレクト
        return redirect('customer.register');
    }


}
