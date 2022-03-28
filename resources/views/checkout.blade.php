<x-guest-layout>

  <div class="product-checkout checkout-cart">

    @livewire('header')

    <div class="checkout main-content">
      <div class="wrap-banner">

        <x-breadcrumb :navs="[
          ['title' => 'Home', 'url' => route('home')],
          ['title' => 'Checkout', 'url' => route('checkout')],
        ]" />

        <!-- main -->
        <div class="wrapper-site">
          <div class="container">
            <div class="row">
              <div class="content-wrapper col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
                <div class="main">
                  <div class="cart-grid row">
                    <div class="col-md-9 check-info">
                      <div class="checkout-personal-step">
                        <h3 class="step-title h3 info">
                          <span class="step-number">1</span>PERSONAL INFORMATION
                        </h3>
                      </div>
                      <div class="content">
                        <ul class="nav nav-inline">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#checkout-guest-form">
                              ORDER AS A GUEST
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#checkout-login-form">
                              SIGN IN
                            </a>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane fade in active show" id="checkout-guest-form" role="tabpanel">
                            <form action="#" id="customer-form" method="post">
                              <div>
                                <input type="hidden" name="id_customer" value="">
                                <div class="form-group row">
                                  <input class="form-control" name="firstname" type="text" placeholder="Full name">
                                </div>
                                <div class="form-group row">
                                  <input class="form-control" name="email" type="email" placeholder="Email">
                                </div>
                                <div class="form-group row">
                                  <input class="form-control" name="email" type="email" placeholder="Phone">
                                </div>
                                <div class="desc-password">
                                  <span class="font-weight-bold">Create an account</span>
                                  <span>(optional)</span>
                                  <br>
                                  <span class="text-muted">And save time on your next order!</span>
                                </div>
                                <div class="form-group row">
                                  <div class="input-group">
                                    <input class="form-control" name="password" type="password" placeholder=" Password">
                                  </div>
                                </div>
                                <div class="hidden-comment">
                                  <div class="form-group row">
                                    <input class="form-control" name="birthday" type="text" value="" placeholder=" Birthdate">
                                  </div>
                                </div>
                                <div class="form-group row check-input">
                                  <span class="custom-checkbox d-inline-flex">
                                    <input class="check" name="optin" type="checkbox" value="1">
                                    <label class="label-absolute">Receive offers from our partners</label>
                                  </span>
                                </div>
                                <div class="form-group row">
                                  <span class="custom-checkbox d-inline-flex check-input">
                                    <input class="check" name="newsletter" type="checkbox" value="1">
                                    <label>Sign up for our newsletter
                                      <br>
                                      <em>You may unsubscribe at any moment. For that purpose,
                                        please find our contact info in the legal notice.
                                      </em>
                                    </label>
                                  </span>
                                </div>
                              </div>
                              <div class="clearfix">
                                <div class="row">
                                  <input type="hidden" name="submitCreate" value="1">

                                  <button class="continue btn btn-primary pull-xs-right" name="continue" data-link-action="register-new-customer" type="submit" value="1">
                                    Continue
                                  </button>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="tab-pane fade" id="checkout-login-form" role="tabpanel">
                            <form id="login-form" action="#" method="post" class="customer-form">
                              <div>
                                <input type="hidden" name="back" value="">
                                <div class="form-group row">
                                  <input class="form-control" name="email" type="email" placeholder="Email">
                                </div>
                                <div class="form-group row">
                                  <div class="input-group">
                                    <input class="form-control" name="password" type="password" placeholder="Password">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="forgot-password">
                                    <a href="user-reset-password.html" rel="nofollow">
                                      Forgot your password?
                                    </a>
                                  </div>
                                </div>
                              </div>
                              <div class="clearfix">
                                <div class="row">
                                  <button class="continue btn btn-primary pull-xs-right" name="continue" data-link-action="sign-in" type="submit" value="1">
                                    Continue
                                  </button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="checkout-personal-step">
                        <h3 class="step-title h3">
                          <span class="step-number">2</span>Addresses
                        </h3>
                      </div>
                      <div class="checkout-personal-step">
                        <h3 class="step-title h3">
                          <span class="step-number">3</span>Shipping Method
                        </h3>
                      </div>
                      <div class="checkout-personal-step">
                        <h3 class="step-title h3">
                          <span class="step-number">4</span>Payment
                        </h3>
                      </div>
                    </div>
                    <div class="cart-grid-right col-xs-12 col-lg-3">
                      <div class="cart-summary">
                        <div class="cart-detailed-totals">
                          <div class="cart-summary-products">
                            <div class="summary-label">There are 3 item in your cart</div>
                          </div>
                          <div class="cart-summary-line" id="cart-subtotal-products">
                            <span class="label">
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
                </div>
              </div>
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