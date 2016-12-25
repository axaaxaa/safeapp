<!-- Aside Start-->
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="index.html" class="logo-expanded">
            <i class="ion-social-buffer"></i>
            <span class="nav-label">Velonic</span>
        </a>
    </div>
    <!-- / brand -->

    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            <li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-format-underlined"></i> <span class="nav-label">用户管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/user') }}">用户列表</a></li>
                    <li><a href="{{ url('/user/create') }}">添加用户</a></li>
                </ul>
            </li>
            {{--<li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-format-underlined"></i> <span class="nav-label">分类管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/class') }}">分类列表</a></li>
                    <li><a href="{{ url('/class/create') }}">分类添加</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#"><i class="zmdi zmdi-format-underlined"></i> <span class="nav-label">商品管理</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/goods') }}">商品列表</a></li>
                    <li><a href="{{ url('/goods/create') }}">添加商品</a></li>
                </ul>
            </li>--}}
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->