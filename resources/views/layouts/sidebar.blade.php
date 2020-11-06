<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <div class="c-sidebar-brand-full">
            <h3>Legal Collection</h3>
        </div>
    </div>
    <ul class="c-sidebar-nav">

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/">
                <i class="fa fa-dashboard c-sidebar-nav-icon"></i>
                Главная
            </a>
        </li>

        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa fa-list c-sidebar-nav-icon"></i>
                Справочники
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                @canAtLeast('notary.view')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{route('notary-index')}}">
                        Нотариусы
                    </a>
                </li>
                @endCanAtLeast

                @canAtLeast('private_bailiff.view')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{route('privateBailiff-index')}}">
                        ЧСИ
                    </a>
                </li>
                @endCanAtLeast
            </ul>
        </li>


        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('settings.index') }}">
                <i class="fa fa-cogs c-sidebar-nav-icon"></i>
                Настройки
            </a>
        </li>

        @canAtLeast('users.view')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('users') }}">
                <i class="fa fa-user c-sidebar-nav-icon"></i>
                Пользователи
            </a>
        </li>
        @endCanAtLeast

        @canAtLeast(['permissions.view', 'permissions.roles'])
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa fa-shield c-sidebar-nav-icon"></i>
                Контроль доступа
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('permissions') }}">
                        Разрешения
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('roles') }}">
                        Роли
                    </a>
                </li>
            </ul>
        </li>
        @endCanAtLeast

    </ul>
    <button class="c-sidebar-minimizer c-class-toggler d-none" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
