<header class="c-header c-header-light c-header-fixed c-header-with-subheader" style="height: 57px">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <i class="fa fa-bars c-icon c-icon-lg"></i>
    </button>
    <a class="c-header-brand d-lg-none" href="#">LEGAL COLLECTION</a>
    <button class="c-header-toggler c-class-toggler mfs-3 d-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <i class="fa fa-bars c-icon c-icon-lg"></i>
    </button>

    <ul class="c-header-nav ml-auto mr-5">
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">

                <div id="name" class="mr-2">
                    {{ Auth::user()->name }}
                </div>

                <div class="c-avatar">
                    <img class="c-avatar-img" style="height: 36px" src="{{ Auth::user()->photo ?? asset('/img/avatars/user-default.png') }}" alt="{{Auth::user()->email}}">
                </div>

            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <a class="dropdown-item" href="{{ route('account') }}">
                    <i class="fa fa-user c-icon mr-2"></i> Мой аккаунт
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fa fa-sign-out c-icon mr-2"></i> Выход
                </a>
            </div>
        </li>
    </ul>
</header>
