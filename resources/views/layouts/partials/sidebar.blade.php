<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="#"><img src="{{ url('srtdash/assets/images/icon/solonet-logo-white.png') }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            @if ( Session::get('role') == 'pembelian' || Session::get('role') == 'management-marketing')
                                <li class=""><a href="{{ route('purchase-order.index') }}"><i class="ti-shopping-cart"></i> <span>Purchase Order</span></a></li>
                                <li><a href="{{ route('history-purchase-order.index') }}"><i class="ti-receipt"></i> <span>History</span></a></li>
                                <li><a href="{{ route('history-pembelian.index') }}"><i class="ti-clipboard"></i> <span>Penerimaan Barang</span></a></li>
                                <li><a href="{{ route('pembayaran.index') }}"><i class="ti-calendar"></i> <span>Jadwal Bayar</span></a></li>
                                <li><a href="{{ route('detail-pembayaran.index') }}"><i class="ti-calendar"></i> <span>History Pembayaran</span></a></li>
                                @endif
                                @if ( Session::get('role') == 'management')
                                <li><a href="{{ route('history-purchase-order.index') }}"><i class="ti-receipt"></i> <span>History</span></a></li>
                                <li><a href="{{ route('history-pembelian.index') }}"><i class="ti-clipboard"></i> <span>Penerimaan Barang</span></a></li>
                                <li><a href="{{ route('pembayaran.index') }}"><i class="ti-calendar"></i> <span>Jadwal Bayar</span></a></li> 
                                <li><a href="{{ route('detail-pembayaran.index') }}"><i class="ti-calendar"></i> <span>History Pembayaran</span></a></li>
                                @endif
                                @if ( Session::get('role') == 'admin-billing')
                                <li class="active"><a href="{{ route('jadwal-bayar.index') }}"><i class="ti-calendar"></i> <span>Jadwal Bayar</span></a></li>
                                <li><a href="{{ route('detail-pembayaran.index') }}"><i class="ti-calendar"></i> <span>History Pembayaran</span></a></li>
                                @endif
                            </ul>
                        </li>
                    @if ( Session::get('role') == 'pembelian' || Session::get('role') == 'management-marketing')
                    <li><a href="{{ route('return-barang.index') }}"><i class="ti-panel"></i> <span>Return Barang</span></a></li>
                    @endif
                    <li>
                        <a href="{{ route('barang.index') }}"><i class="ti-briefcase"></i> <span>Barang</span></a>
                    </li>
                    <li><a href="{{ route('distributor.index') }}"><i class="ti-truck"></i> <span>Data Distributor</span></a></li>
                    <li><a href="{{ route('ekstra.index') }}"><i class="ti-panel"></i> <span>Extra</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->
