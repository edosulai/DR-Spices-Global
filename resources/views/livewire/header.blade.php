<header>
    <div class="header-mobile d-md-none">
        <div class="mobile hidden-md-up text-xs-center d-flex align-items-center justify-content-around">

            <div id="mobile_search" class="d-flex">
                <div class="desktop_cart">
                    <div class="blockcart block-cart cart-preview tiva-toggle">
                        <div class="header-cart tiva-toggle-btn">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </div>
                        <div class="dropdown-content">
                            <div class="cart-content">
                                <table>
                                    <tbody>
                                        @foreach ($carts as $cart)
                                        <tr>
                                            <td class="product-image">
                                                <a href="{{ $cart['url'] }}">
                                                    <img src="{{ $cart['img_src'] }}" alt="Product">
                                                </a>
                                            </td>
                                            <td>
                                                <div class="product-name">
                                                    <a href="{{ $cart['url'] }}">{{ $cart['name'] }}</a>
                                                </div>
                                                <div>({{ $cart['unit'] }}) {{ $cart['qty'] }} x <span class="product-price">Rp. {{ number_format($cart['price'], 0, ',', '.') }}</span></div>
                                            </td>
                                            <td class="action">
                                                <a class="remove" href="#" role="button">
                                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if ($carts->isNotEmpty())
                                        <tr class="total">
                                            <td colspan="2">Total:</td>
                                            <td>Rp. {{ number_format($carts->sum(function ($cart) {
                                                return $cart['qty'] * $cart['price'];
                                            }), 0, ',', '.') }}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>
                                                <p>{{ __('Empty Cart') }}</p>
                                            </td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td colspan="3" class="d-flex justify-content-center">
                                                <div class="cart-button">
                                                    <a href="{{ Auth::check() ? route('cart') : route('login') }}" title="View Cart">View Cart</a>
                                                    <a href="{{ Auth::check() ? route('checkout') : route('login') }}" title="Checkout">Checkout</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mobile-logo">
                <a href="{{ route('home') }}">
                    <img class="logo-mobile img-fluid" src="{{ asset('storage/images/home/logo-mobie.png') }}" alt="Prestashop_Furnitica">
                </a>
            </div>

            <div class="mobile-menutop" data-target="#mobile-pagemenu">
                <i class="fas fa-ellipsis-h"></i>
            </div>
        </div>
    </div>


    <div class="header-top d-xs-none ">
        <div class="container">
            <div class="row">

                <div class="col-sm-2 col-md-2 d-flex align-items-center">
                    <div id="logo">
                        <a href="{{ route('home') }}">
                            <img class="img-fluid" src="{{ asset('storage/images/home/logo.png') }}" alt="logo">
                        </a>
                    </div>
                </div>


                <div class="main-menu col-sm-4 col-md-5 align-items-center justify-content-center navbar-expand-md">
                    <div class="menu navbar collapse navbar-collapse">
                        <ul class="menu-top navbar-nav">
                            @foreach ($navs as $nav)
                            <li class="{{ request()->url() == $nav['url'] ? 'nav-link' : '' }}">
                                <a href="{{ $nav['url'] }}" class="parent">{{ $nav['name'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div id="search_widget" class="col-sm-6 col-md-5 align-items-center justify-content-end d-flex">

                    @if (Auth::check())
                    <div id="block_myaccount_infos" class="hidden-sm-down dropdown">
                        <div class="myaccount-title">
                            <a href="#account" data-toggle="collapse" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div id="account" class="account collapse">
                            <div class="account-list-content">
                                @role('admin')
                                <div>
                                    <a href="{{ route('dashboard') }}" title="Dashboard">
                                        <i class="fas fa-columns"></i>
                                        <span>{{ __('Dashboard') }}</span>
                                    </a>
                                </div>
                                @endif
                                @foreach ($user_navs as $nav)
                                <div>
                                    <a href="{{ $nav['url'] }}" title="{{ $nav['title'] }}">
                                        <i class="{{ $nav['icon'] }}"></i>
                                        <span>{{ $nav['name'] }}</span>
                                    </a>
                                </div>
                                @endforeach
                                <div>
                                    <a href="#" role="button" title="Sign Out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>{{ __('Sign Out') }}</span>
                                    </a>
                                    <form class="d-none" method="POST" id="logout-form" action="{{ route('logout') }}">@csrf</form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="desktop_cart">
                        <div class="blockcart block-cart cart-preview tiva-toggle">
                            <div class="header-cart tiva-toggle-btn">
                                @if ($carts->isNotEmpty())
                                <span class="cart-products-count">{{ $carts->count() }}</span>
                                @endif
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </div>
                            <div class="dropdown-content">
                                <div class="cart-content">
                                    <table>
                                        <tbody>
                                            @foreach ($carts as $cart)
                                            <tr>
                                                <td class="product-image">
                                                    <a href="{{ $cart['url'] }}">
                                                        <img src="{{ $cart['img_src'] }}" alt="Product">
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="product-name">
                                                        <a href="{{ $cart['url'] }}">{{ $cart['name'] }}</a>
                                                    </div>
                                                    <div>({{ $cart['unit'] }}) {{ $cart['qty'] }} x <span class="product-price">Rp. {{ number_format($cart['price'], 0, ',', '.') }}</span></div>
                                                </td>
                                                <td class="action">
                                                    <button class="remove btn p-0"  wire:click="deleteCart({{ $cart['id'] }})">
                                                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @if ($carts->isNotEmpty())
                                            <tr class="total">
                                                <td colspan="2">Total:</td>
                                                <td>Rp. {{ number_format($carts->sum(function ($cart) {
                                                    return $cart['qty'] * $cart['price'];
                                                }), 0, ',', '.') }}</td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td>
                                                    <p>{{ __('Empty Cart') }}</p>
                                                </td>
                                            </tr>
                                            @endif

                                            <tr>
                                                <td colspan="3" class="d-flex justify-content-center">
                                                    <div class="cart-button">
                                                        <a href="{{ Auth::check() ? route('cart') : route('login') }}" title="View Cart">View Cart</a>
                                                        <a href="{{ Auth::check() ? route('checkout') : route('login') }}" title="Checkout">Checkout</a>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    @else
                    <div id="block_myaccount_infos" class="hidden-sm-down dropdown">
                        <div class="myaccount-title">
                            <div>
                                <a href="{{ route('login') }}" title="Log in to your customer account">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>{{ __('Sign in') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="mobile-pagemenu" class="mobile-boxpage d-flex hidden-md-up active d-md-none">
        <div class="content-boxpage col">
            <div class="box-header d-flex justify-content-between align-items-center">
                <div class="title-box">{{ __('Menu') }}</div>
                <div class="close-box">{{ __('Close') }}</div>
            </div>
            <div class="box-content">
                <nav>
                    
                    <div id="megamenu" class="clearfix">
                        <ul class="menu level1">
                            @foreach ($navs as $nav)
                            <li class="item has-sub">
                                <a href="{{ $nav['url'] }}" title="{{ $nav['name'] }}">
                                    <i class="{{ $nav['icon'] }}" aria-hidden="true"></i>{{ $nav['name'] }}
                                </a>
                            </li>
                            @endforeach

                            @if (Auth::check())
                            <li class="item has-sub">
                                <span class="arrow collapsed" data-toggle="collapse" data-target="#home1" aria-expanded="true" role="status">
                                    <i class="fas fa-minus"></i>
                                    <i class="fas fa-plus"></i>
                                </span>
                                <a href="index-2.html" title="Home">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <div class="subCategory collapse" id="home1" aria-expanded="true" role="status">
                                    <ul>
                                        @role('admin')
                                        <li class="item">
                                            <a href="{{ route('dashboard') }}" title="Dashboard">
                                                <span>{{ __('Dashboard') }}</span>
                                            </a>
                                        </li>
                                        @endif
                                        @foreach ($user_navs as $nav)
                                        <li class="item">
                                            <a href="{{ $nav['url'] }}" title="{{ $nav['title'] }}">
                                                <span>{{ $nav['name'] }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                        <li class="item">
                                            <a href="#" title="Sign Out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <span>{{ __('Sign Out') }}</span>
                                            </a>
                                            <form class="d-none" method="POST" id="logout-form" action="{{ route('logout') }}">@csrf</form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @else
                            <li class="item has-sub">
                                <a href="{{ route('login') }}" title="Log in to your customer account">
                                    <i class="fas fa-sign-in-alt" aria-hidden="true"></i>{{ __('Sign in') }}
                                </a>
                            </li>
                            @endif

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</header>