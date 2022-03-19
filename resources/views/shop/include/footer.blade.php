<div id="footer">
    <div class="footer_inner">
        <div  class="contents_list">
            <table>
                <colgroup> 
                    <col style='width: 25%;'>
                    <col style='width: 25%;'>
                    <col style='width: 25%;'>
                    <col style='width: 25%;'>
                </colgroup>
                <thead>
                    <tr >
                        <td colspan="4">Contents</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="{{ route('shops.home') }}">
                                HOME
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('shops.offer_menu') }}">
                                原価ticketメニュー
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('shops.showEditInfoForm') }}">
                                店舗情報
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('shops.showTicketList') }}">
                                ticket履歴
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a title="ただいま準備中です。今しばらくお待ちください。">
                                管理ページの使い方
                            </a>
                        </td>
                        <td>
                            <a title="ただいま準備中です。今しばらくお待ちください。">
                                よくある質問
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('shops.showRule') }}">
                                利用規約
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('shops.showAdmin') }}">
                                運営元
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="link_list">
            <table>
                <tbody>
                <tr>
                        <td class="sns_list">
                            <a href="{{ route('shops.home') }}">
                                <img src="{{asset('images/common/sns/Twitter_black.svg')}}">
                            </a>
                            <a href="{{ route('shops.home') }}">
                                <img src="{{asset('images/common/sns/Facebook_black.svg')}}">
                            </a>
                            <a href="{{ route('shops.home') }}">
                                <img src="{{asset('images/common/sns/Instagram_black.svg')}}">
                            </a>
                            <a href="{{ route('shops.home') }}">
                                <img src="{{asset('images/common/sns/Youtube_black.svg')}}">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="logo_area">
                            <a href="{{ route('shops.home') }}">
                                <img src="{{asset('images/common/site_logo.jpg')}}">
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="call_right">
        © 2022 Keisuke Iwasada
    </div>
</div>