<x-guest-layout>

  <div class="product-cart checkout-cart blog">

    @livewire('header')

    <div class="main-content cart">
      <!-- main -->
      <div class="wrapper-site">
        
        <x-breadcrumb :navs="[
          ['title' => 'Home', 'url' => route('home')],
          ['title' => 'Shopping Cart', 'url' => route('cart')],
        ]" />

        <div class="container">
          <div class="row">
            <div class="content-wrapper col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
              <section class="main">
                <div class="cart-grid row">
                  <div class="col-md-9 col-xs-12 check-info">
                    <h1 class="title-page">Shopping Cart</h1>
                    <div class="cart-container">
                      <div class="cart-overview js-cart">
                        <ul class="cart-items">
                          <li class="cart-item">
                            <div class="product-line-grid row justify-content-between">
                              <!--  product left content: image-->
                              <div class="product-line-grid-left col-md-2">
                                <span class="product-image media-middle">
                                  <a href="product-detail.html">
                                    <img class="img-fluid" src="{{ asset('storage/images/product/3.jpg') }}" alt="Organic Strawberry Fruits">
                                  </a>
                                </span>
                              </div>
                              <div class="product-line-grid-body col-md-6">
                                <div class="product-line-info">
                                  <a class="label" href="product-detail.html" data-id_customization="0">Organic Strawberry Fruits</a>
                                </div>
                                <div class="product-line-info product-price">
                                  <span class="value">£20.00</span>
                                </div>
                                <div class="product-line-info">
                                  <span class="label-atrr">Size:</span>
                                  <span class="value">S</span>
                                </div>
                                <div class="product-line-info">
                                  <span class="label-atrr">Color:</span>
                                  <span class="value">Blue</span>
                                </div>
                              </div>
                              <div class="product-line-grid-right text-center product-line-actions col-md-4">
                                <div class="row">
                                  <div class="col-md-5 col qty">
                                    <div class="label">Qty:</div>
                                    <div class="quantity">
                                      <input type="text" name="qty" value="1" class="input-group form-control">

                                      <span class="input-group-btn-vertical">
                                        <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-up" type="button">
                                          +
                                        </button>
                                        <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-down" type="button">
                                          -
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                  <div class="col-md-5 col price">
                                    <div class="label">Total:</div>
                                    <div class="product-price total">
                                      £20.00
                                    </div>
                                  </div>
                                  <div class="col-md-2 col text-xs-right align-self-end">
                                    <div class="cart-line-product-actions ">
                                      <a class="remove-from-cart" rel="nofollow" href="#" data-link-action="delete-from-cart" data-id-product="1">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="cart-item">
                            <div class="product-line-grid row justify-content-between">
                              <!--  product left content: image-->
                              <div class="product-line-grid-left col-md-2">
                                <span class="product-image media-middle">
                                  <a href="product-detail.html">
                                    <img class="img-fluid" src="{{ asset('storage/images/product/2.jpg') }}" alt="Organic Strawberry Fruits">
                                  </a>
                                </span>
                              </div>
                              <div class="product-line-grid-body col-md-6">
                                <div class="product-line-info">
                                  <a class="label" href="product-detail.html" data-id_customization="0">
                                    Etiam Congue Nisl Nec</a>
                                </div>
                                <div class="product-line-info product-price">
                                  <span class="value">£30.00</span>
                                </div>
                                <div class="product-line-info">
                                  <span class="label-atrr">Size:</span>
                                  <span class="value">S</span>
                                </div>
                                <div class="product-line-info">
                                  <span class="label-atrr">Color:</span>
                                  <span class="value">Blue</span>
                                </div>
                              </div>
                              <div class="product-line-grid-right text-center product-line-actions col-md-4">
                                <div class="row">
                                  <div class="col-md-5 qty col">
                                    <div class="label">Qty:</div>
                                    <div class="quantity">
                                      <input type="text" name="qty" value="2" class="input-group form-control">

                                      <span class="input-group-btn-vertical">
                                        <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-up" type="button">
                                          +
                                        </button>
                                        <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-down" type="button">
                                          -
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                  <div class="col-md-5 price col">
                                    <div class="label">Total:</div>
                                    <div class="product-price total">
                                      £60.00
                                    </div>
                                  </div>
                                  <div class="col-md-2 text-xs-right align-self-end col">
                                    <div class="cart-line-product-actions ">
                                      <a class="remove-from-cart" rel="nofollow" href="#" data-link-action="delete-from-cart" data-id-product="1">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="cart-item">
                            <div class="product-line-grid row justify-content-between">
                              <!--  product left content: image-->
                              <div class="product-line-grid-left col-md-2">
                                <span class="product-image media-middle">
                                  <a href="product-detail.html">
                                    <img class="img-fluid" src="{{ asset('storage/images/product/1.jpg') }}" alt="Organic Strawberry Fruits">
                                  </a>
                                </span>
                              </div>
                              <div class="product-line-grid-body col-md-6">
                                <div class="product-line-info">
                                  <a class="label" href="product-detail.html" data-id_customization="0">Nulla Et Justo Non Augue</a>
                                </div>
                                <div class="product-line-info product-price">
                                  <span class="value">£40.00</span>
                                </div>
                                <div class="product-line-info">
                                  <span class="label-atrr">Size:</span>
                                  <span class="value">S</span>
                                </div>
                                <div class="product-line-info">
                                  <span class="label-atrr">Color:</span>
                                  <span class="value">Blue</span>
                                </div>
                              </div>
                              <div class="product-line-grid-right text-center product-line-actions col-md-4">
                                <div class="row">
                                  <div class="col-md-5 col qty">
                                    <div class="label">Qty:</div>
                                    <div class="quantity">
                                      <input type="text" name="qty" value="3" class="input-group form-control">

                                      <span class="input-group-btn-vertical">
                                        <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-up" type="button">
                                          +
                                        </button>
                                        <button class="btn btn-touchspin js-touchspin bootstrap-touchspin-down" type="button">
                                          -
                                        </button>
                                      </span>
                                    </div>
                                  </div>
                                  <div class="col-md-5 col price">
                                    <div class="label">Total:</div>
                                    <div class="product-price total">
                                      £120.00
                                    </div>
                                  </div>
                                  <div class="col-md-2 col text-xs-right align-self-end">
                                    <div class="cart-line-product-actions ">
                                      <a class="remove-from-cart" rel="nofollow" href="#" data-link-action="delete-from-cart" data-id-product="1">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <a href="product-checkout.html" class="continue btn btn-primary pull-xs-right">
                      Continue
                    </a>
                  </div>
                  <div class="cart-grid-right col-xs-12 col-lg-3">
                    <div class="cart-summary">
                      <div class="cart-detailed-totals">
                        <div class="cart-summary-products">
                          <div class="summary-label">There are 3 item in your cart</div>
                        </div>
                        <div class="cart-summary-line" id="cart-subtotal-products">
                          <span class="label js-subtotal">
                            Total products:
                          </span>
                          <span class="value">£200.00</span>
                        </div>
                        <div class="cart-summary-line" id="cart-subtotal-shipping">
                          <span class="label">
                            Total Shipping:
                          </span>
                          <span class="value">Free</span>
                          <div>
                            <small class="value"></small>
                          </div>
                        </div>
                        <div class="cart-summary-line cart-total">
                          <span class="label">Total:</span>
                          <span class="value">£200.00 (tax incl.)</span>
                        </div>
                      </div>
                    </div>
                    <div id="block-reassurance">
                      <ul>
                        <li>
                          <div class="block-reassurance-item">
                            <img src="{{ asset('storage/images/product/check1.png') }}" alt="Security policy (edit with Customer reassurance module)">
                            <span>Security policy (edit with Customer reassurance module)</span>
                          </div>
                        </li>
                        <li>
                          <div class="block-reassurance-item">
                            <img src="{{ asset('storage/images/product/check2.png') }}" alt="Delivery policy (edit with Customer reassurance module)">
                            <span>Delivery policy (edit with Customer reassurance module)</span>
                          </div>
                        </li>
                        <li>
                          <div class="block-reassurance-item">
                            <img src="{{ asset('storage/images/product/check3.png') }}" alt="Return policy (edit with Customer reassurance module)">
                            <span>Return policy (edit with Customer reassurance module)</span>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>

    <x-footer />

    <x-pre-loader />

    <x-back-top />

  </div>

</x-guest-layout>