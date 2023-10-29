<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="">
                    <span class="brand-logo">
                        <x-app-logo />
                    </span>
                    <h2 class="brand-text">{{ env('APP_NAME') }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                <x-sidebar-link icon="grid" title="Dashboard" :route="route('dashboard.index')">Dashboard</x-sidebar-link>
            </li>


            <li class=" nav-item {{ request()->routeIs('dashboard.dompet*') ? 'active' : '' }} ">
                <x-sidebar-link icon="credit-card" title="dompet" :route="route('dashboard.dompet.index')">Dompet</x-sidebar-link>
            </li>
            <li class=" nav-item {{ request()->routeIs('dashboard.transaksi*') ? 'active' : '' }} ">
                <x-sidebar-link icon="shopping-cart" title="Dashboard" :route="route('dashboard.transaksi.index')">Transaksi</x-sidebar-link>
            </li>
            <li class=" nav-item {{ request()->routeIs('dashboard.report.transaksi*') ? 'open' : '' }}">
                <a class="d-flex align-items-center" href="#"><i data-feather="book"></i><span
                        class="menu-title text-truncate" data-i18n="Dashboards">Laporan Transaksi</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('dashboard.report.transaksi.harian') ? 'active' : '' }}">
                        <x-sidebar-link icon="circle" title="Laporan Transaksi Harian"
                            :route="route('dashboard.report.transaksi.harian')">Harian</x-sidebar-link>

                    </li>
                    <li class="{{ request()->routeIs('dashboard.report.transaksi.bulanan') ? 'active' : '' }}">
                        <x-sidebar-link icon="circle" title="Laporan Transaksi Bulanan"
                            :route="route('dashboard.report.transaksi.bulanan')">Bulanan</x-sidebar-link>
                    </li>
                    <li class="{{ request()->routeIs('dashboard.report.transaksi.tahunan') ? 'active' : '' }}">
                        <x-sidebar-link icon="circle" title="Laporan Transaksi Tahunan"
                            :route="route('dashboard.report.transaksi.tahunan')">Tahunan</x-sidebar-link>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</div>
