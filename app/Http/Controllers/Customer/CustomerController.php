<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Controllers\CommonController;
use \App\Models\Customer\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \App\Libraries\LineClass;
use Illuminate\Support\Facades\Log;


class CustomerController extends Controller
{
    //
    public function showLoginForm()
    {
        $commonController = new CommonController;
        $commonController->selectBrowser();
        return view('customer.' . USER_AGENT . '.login');
    }

    public function login(Request $request)
    {

        $lineClass = new LineClass;
        return $lineClass->authorize(env('APP_URL').'/customer/linelink');
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

            // 未登録の場合、登録画面にリダイレクト
            if (is_null($customer)) {
                // LINEユーザー情報をセッションに保存
                session(['line.user' => $lineUserDetail]);

                return redirect('customer/regist');
            }

            // セッションに保存
            $credentials = [
                'line_user_key' => $lineUserDetail['line_user_id'],
            ];
            $guard = "customers";
            if (Auth::guard($guard)->loginUsingId($customer->id)) {
                $request->session()->put('id', $customer->id);
            }

        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            // $this->Flash->error('エラーが発生しました。何度も続く場合は、お問い合わせください。');
            return redirect('/');
        }

        // ホーム画面にリダイレクト
        return redirect('customer/home');
    }

    /**
     * ログアウト
     *  - 全セッション削除
     */
    public function logout(Request $request)
    {

        Auth::logout();
        Session::flush();
        return redirect('customer');
    }

}
