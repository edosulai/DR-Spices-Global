<header>
    <!-- header left mobie -->
    <div class="header-mobile d-md-none">
        <div class="mobile hidden-md-up text-xs-center d-flex align-items-center justify-content-around">

            <!-- menu left -->
            <div id="mobile_mainmenu" class="item-mobile-top">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>

            <!-- logo -->
            <div class="mobile-logo">
                <a href="index-2.html">
                    <img class="logo-mobile img-fluid" src="{{ asset('storage/images/home/logo-mobie.png') }}" alt="Prestashop_Furnitica">
                </a>
            </div>

            <!-- menu right -->
            <div class="mobile-menutop" data-target="#mobile-pagemenu">
                <i class="zmdi zmdi-more"></i>
            </div>
        </div>

        <!-- search -->
        <div id="mobile_search" class="d-flex">
            <div class="desktop_cart">
                <div class="blockcart block-cart cart-preview tiva-toggle">
                    <div class="header-cart tiva-toggle-btn">
                        <span class="cart-products-count">1</span>
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
                                            <div>{{ $cart['qty'] }} x <span class="product-price">Rp. {{ number_format($cart['price'], 0, ',', '.') }}</span></div>
                                        </td>
                                        <td class="action">
                                            <a class="remove" href="#">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="total">
                                        <td colspan="2">Total:</td>
                                        <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" class="d-flex justify-content-center">
                                            <div class="cart-button">
                                                <a href="product-cart.html" title="View Cart">View Cart</a>
                                                <a href="product-checkout.html" title="Checkout">Checkout</a>
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
    </div>

    <!-- header desktop -->
    <div class="header-top d-xs-none ">
        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col-sm-2 col-md-2 d-flex align-items-center">
                    <div id="logo">
                        <a href="index-2.html">
                            <img class="img-fluid" src="{{ asset('storage/images/home/logo.png') }}" alt="logo">
                        </a>
                    </div>
                </div>

                <!-- menu -->
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

                <!-- search-->
                <div id="search_widget" class="col-sm-6 col-md-5 align-items-center justify-content-end d-flex">

                    <!-- acount  -->
                    @if (Auth::check())
                    <div id="block_myaccount_infos" class="hidden-sm-down dropdown">
                        <div class="myaccount-title">
                            <a href="#acount" data-toggle="collapse" class="acount">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>{{ $user->name }}</span>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div id="acount" class="collapse">
                            <div class="account-list-content">
                                @foreach ($user_navs as $nav)
                                <div>
                                    <a href="{{ $nav['url'] }}" rel="nofollow" title="{{ $nav['title'] }}">
                                        <i class="{{ $nav['icon'] }}"></i>
                                        <span>{{ $nav['name'] }}</span>
                                    </a>
                                </div>
                                @endforeach
                                <div id="desktop_language_selector" class="language-selector groups-selector hidden-sm-down">
                                    <ul class="list-inline">
                                        <li class="list-inline-item current">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ asset('storage/images/home/home1-flas.jpg') }}" alt="English" width="16" height="11">
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ asset('storage/images/home/home1-flas2.jpg') }}" alt="Italiano" width="16" height="11">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="desktop_cart">
                        <div class="blockcart block-cart cart-preview tiva-toggle">
                            <div class="header-cart tiva-toggle-btn">
                                <span class="cart-products-count">1</span>
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
                                                    <div>{{ $cart['qty'] }} x <span class="product-price">Rp. {{ number_format($cart['price'], 0, ',', '.') }}</span></div>
                                                </td>
                                                <td class="action">
                                                    <a class="remove" href="#">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr class="total">
                                                <td colspan="2">Total:</td>
                                                <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                                            </tr>

                                            <tr>
                                                <td colspan="3" class="d-flex justify-content-center">
                                                    <div class="cart-button">
                                                        <a href="product-cart.html" title="View Cart">View Cart</a>
                                                        <a href="product-checkout.html" title="Checkout">Checkout</a>
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
                                <a href="user-login.html" rel="nofollow" title="Log in to your customer account">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Sign in</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>