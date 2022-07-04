<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <x-jet-application-mark width="36" class="text-light" />
        </div>
        <div class="sidebar-brand-text mx-3"><small>{{ config('app.name', 'Laravel') }}</small></div> --}}
        <img class="img-fluid w-60" src="{{ asset('storage/images/others/logo.png') }}" alt="DR Maggots Global Logo">
    </a>


    <hr class="sidebar-divider my-0">

    <x-jet-nav-link :active="request()->routeIs('dashboard')">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span>
        </a>
    </x-jet-nav-link>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Master</div>

    <x-jet-nav-link>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaction" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>{{ __('Transaksi') }}</span>
        </a>
        <div id="collapseTransaction" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Riwayat Transaksi : </h6>
                <a class="collapse-item {{ request()->routeIs('tertunda.index') ? 'active font-weight-bolder' : '' }}" href="{{ route('tertunda.index') }}">Order</a>
                <a class="collapse-item {{ request()->routeIs('pengeluaran.index') ? 'active font-weight-bolder' : '' }}" href="{{ route('pengeluaran.index') }}">Outcome</a>
                <a class="collapse-item {{ request()->routeIs('pendapatan.index') ? 'active font-weight-bolder' : '' }}" href="{{ route('pendapatan.index') }}">Income</a>
            </div>
        </div>
    </x-jet-nav-link>

    <x-jet-nav-link>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEntities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('Entitas') }}</span>
        </a>
        <div id="collapseEntities" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Entitas : </h6>
                <a class="collapse-item {{ request()->routeIs('pengguna.index') ? 'active font-weight-bolder' : '' }}" href="{{ route('pengguna.index') }}">Pengguna</a>
                <a class="collapse-item {{ request()->routeIs('pemasok.index') ? 'active font-weight-bolder' : '' }}" href="{{ route('pemasok.index') }}">Supplier</a>
            </div>
        </div>
    </x-jet-nav-link>

    <x-jet-nav-link :active="request()->routeIs('maggot.index')">
        <a class="nav-link" href="{{ route('maggot.index') }}">
            <i class="fas fa-fw fa-mortar-pestle"></i>
            <span>{{ __('Maggot') }}</span>
        </a>
    </x-jet-nav-link>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Layanan</div>

    <x-jet-nav-link :active="request()->routeIs('pesan.index')">
        <a class="nav-link" href="{{ route('pesan.index') }}">
            <i class="fas fa-envelope-square"></i>
            <span>{{ __('Daftar Kontak Surat') }}</span>
        </a>
    </x-jet-nav-link>

    <x-jet-nav-link :active="request()->routeIs('refund.index')">
        <a class="nav-link" href="{{ route('refund.index') }}">
            <i class="fas fa-undo-alt"></i>
            <span>{{ __('Daftar Refund') }}</span>
        </a>
    </x-jet-nav-link>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Lainnya</div>

    <x-jet-nav-link :active="request()->routeIs('status.index')">
        <a class="nav-link" href="{{ route('status.index') }}">
            <i class="fas fa-fw fa-truck-loading"></i>
            <span>{{ __('Status Pengiriman') }}</span>
        </a>
    </x-jet-nav-link>

    <x-jet-nav-link :active="request()->routeIs('ongkir.index')">
        <a class="nav-link" href="{{ route('ongkir.index') }}">
            <i class="fas fa-fw fa-money-check"></i>
            <span>{{ __('Ongkos Pengiriman') }}</span>
        </a>
    </x-jet-nav-link>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
