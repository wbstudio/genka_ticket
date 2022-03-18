<div class="logo_area">
    <img src="{{ asset('images/common/site_logo.jpg') }}">
    <div class="string">
    Management screen
    </div>
</div>

<ul>
    <a href="{{ route('shops.home') }}">
        <li>
            HOME
        </li>
    </a>
    <a href="{{ route('shops.offer_menu') }}">
        <li>
            原価ticket-メニュー編集
        </li>
    </a>
    <a href="{{ route('shops.showEditInfoForm') }}">
        <li>
            店舗情報編集
        </li>
    </a>
    <a href="{{ route('shops.showTicketList') }}">
        <li>
            ticket利用履歴
        </li>
    </a>
    <a href="{{ route('shops.showContactForm') }}">
        <li>
            お問い合わせ
        </li>
    </a>
    <a href="{{ route('shops.showRule') }}">
        <li>
            利用規約
        </li>
    </a>
    <a href="{{ route('shops.logout')}}">
        <li>
            ログアウト
        </li>
    </a>
</ul>