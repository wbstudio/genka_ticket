<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <div class="modal_head">
            <div class="modal_head_name">
                <img src="{{ asset('images/customer/sp/modal_logo.png')}}">
            </div>
            <div class="js-modal-close"></div>                
        </div>
        <div class="modal_contents">
            <table>
                <tr class="single">
                    <td colspan="2">
                        <a href="{{ route('customer.home') }}">
                            <div class="inner_contents">HOME</div>
                        </a>
                    </td>
                </tr>
                <tr class="double">
                    <td>
                        <a href="{{ route('customer.search')}}">
                            <div class="inner_contents left">Search</div>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('customer.map')}}">
                            <div class="inner_contents right">Map</div>
                        </a>
                    </td>
                </tr>
                <tr class="double">
                    <td>
                        <a href="{{ route('customer.ticket')}}">
                            <div class="inner_contents left">Ticket</div>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('customer.bill')}}">
                            <div class="inner_contents right">Bill</div>
                        </a>
                    </td>
                </tr>
                <tr class="single">
                    <td colspan="2">
                        <a href="{{ route('customer.history')}}">
                            <div class="inner_contents">履歴</div>
                        </a>
                    </td>
                </tr>
                <tr class="single">
                    <td colspan="2">
                    <a href="{{ route('customer.profile')}}">
                        <div class="inner_contents">プロフ</div>
                    </a>
                    </td>
                </tr>
                <!-- <tr class="single">
                    <td colspan="2">
                        <div class="inner_contents">といあわせ</div>
                    </td>
                </tr> -->
                <tr class="single">
                    <td colspan="2">
                        <a href="{{ route('customer.explanation')}}">
                            <div class="inner_contents">how to</div>
                        </a>    
                    </td>
                </tr>
                <tr class="single">
                    <td colspan="2">
                        <a href="{{ route('customer.explanation')}}">
                            <div class="inner_contents">news</div>
                        </a>
                    </td>
                </tr>
                <!-- <tr class="single">
                    <td colspan="2">
                        <div class="inner_contents">会社情報</div>
                    </td>
                </tr> -->
                <tr class="single">
                    <td colspan="2">
                        <a href="{{ route('customer.logout') }}">
                            <div class="inner_contents">log out</div>
                        </a>
                    </td>
                </tr>
            </table>
            <!-- <ul>
                <li>
                    <a href="{{ route('customer.history')}}">
                        <div class="link_mass">
                        <div class="link_name">履歴</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.profile')}}">
                        <div class="link_mass">
                        <div class="link_name">プロフィール設定</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.contact')}}">
                        <div class="link_mass">
                        <div class="link_name">お問い合わせ</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.rule')}}">
                        <div class="link_mass">
                        <div class="link_name">規約</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.explanation')}}">
                        <div class="link_mass">
                        <div class="link_name">使い方</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="link_mass">
                        <div class="link_name"><a href="{{ route('customer.logout') }}">ログアウト</a></div>
                        </div>
                    </a>
                </li>
            </ul> -->
        </div>
    </div><!--modal__inner-->
</div><!--modal-->