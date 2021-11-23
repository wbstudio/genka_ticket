<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <div class="modal_head">
            <div class="modal_head_name">
                <span>Menu</span>
            </div>
            <div class="js-modal-close"></div>                
        </div>
        <div class="modal_contents">
            <ul>
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
            </ul>
        </div>
    </div><!--modal__inner-->
</div><!--modal-->