<aside
    id='layout-menu'
    class='layout-menu menu-vertical menu bg-menu-theme'
    data-bg-class='bg-menu-theme'
>
    <div class='app-brand demo'>
        <a href='/admin' class='app-brand-link'>
            <img src='/temp/images/general/logo.png' width='200' alt='' />
        </a>

        <a
            href='javascript:void(0);'
            class='layout-menu-toggle menu-link text-large ms-auto d-xl-none'
        >
            <i class='bx bx-chevron-left bx-sm align-middle'></i>
        </a>
    </div>

    <div class='menu-inner-shadow'></div>

    <ul class='menu-inner py-1 ps ps--active-y'>
        <!-- Dashboard -->
        <li class='menu-item active'>
            <a href='/home' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-home-circle'></i>
                <div data-i18n='Analytics'>Dashboard</div>
            </a>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Người dùng & Khách hàng</span>
        </li>
        @if(auth()->user()->role->isAdmin())
            <li class='menu-item'>
                <a href='{{route("roles.index")}}' class='menu-link'>
                    <i class='menu-icon tf-icons bx bxs-user-account'></i>
                    <div data-i18n='Layouts'>Quản lý quyền</div>
                </a>

            <li class='menu-item'>
                <a href='{{route("users.index")}}' class='menu-link '>
                    <i class='menu-icon tf-icons bx bxs-user-account'></i>
                    <div data-i18n='Layouts'>Tài khoản quản trị</div>
                </a>
            </li>
        @endif
        <li class='menu-item'>
            <a href='{{route("customers.index")}}' class='menu-link '>
                <i class='menu-icon tf-icons bx bxs-user-account'></i>
                <div data-i18n='Layouts'>Tài khoản khách hàng</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Danh mục & Sản phẩm</span>
        </li>
        <li class='menu-item'>
            <a href='{{route("categories.index")}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-category-alt'></i>
                <div data-i18n='Layouts'>Quản lý danh mục</div>
            </a>
        </li>
        <li class='menu-item'>
            <a href='{{route("products.index")}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-store-alt'></i>
                <div data-i18n='Layouts'>Quản lý sản phẩm</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Kho & Cho thuê</span>
        </li>
        <li class='menu-item'>
            <a href='{{route("khos.index")}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-street-view'></i>
                <div data-i18n='Layouts'>Quản lý Kho </div>
            </a>
        </li>
        <li class='menu-item'>
            <a href='{{route("chothues.index")}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-food-menu'></i>
                <div data-i18n='Layouts'>Cho thuê</div>
            </a>
        </li>
        <li class='menu-item'>
            <a href='{{route("doanhthus.index")}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-food-menu'></i>
                <div data-i18n='Layouts'>Doanh thu theo kho</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Setting</span>
        </li>
        <li class='menu-item'>
            <a href='{{route("settings.index")}}' class='menu-link'>
                <i class='menu-icon tf-icons bx bx-street-view'></i>
                <div data-i18n='Layouts'>Cấu hình</div>
            </a>
        </li>
    </ul>
</aside>
