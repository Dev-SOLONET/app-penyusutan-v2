<div class="container d-print-none">
    <div class="row align-items-center">
        <div class="col-lg-9 d-none d-lg-block">
            <div class="horizontal-menu ml-md-2">
                <nav>
                    <ul id="nav_menu">
                        <li>
                            <a href="javascript:void(0)"><i class="ti-angle-double-down"></i><span>Menu Tambahan</span></a>
                            <ul class="submenu">
                                    <li><a href="{{ route('management.biaya-tetap.index') }}"><i class="ti-menu"></i><span>Biaya Tetap</span></a></li>
                                    <li><a href="{{ route('management.biaya-dimuka.index') }}"><i class="ti-menu-alt"></i><span>Biaya Dimuka</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="ti-settings"></i><span>Extra</span></a>
                            <ul class="submenu">
                                <li><a href="{{ route('admin.pengguna.index') }}"><i class="ti-user"></i> <span>Pengguna</span></a></li>
                                <li><a href="{{ route('admin.satuan.index')}}"><i class="ti-ruler-alt-2"></i> <span>Satuan</span></a></li>
                            </ul>
                        </li>
                    </ul>


                </nav>
            </div>
        </div>
        <!-- mobile_menu -->
        <div class="col-12 d-block d-lg-none">
            <div id="mobile_menu"></div>
        </div>
    </div>
</div>
<!-- header area end -->