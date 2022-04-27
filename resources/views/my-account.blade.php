<x-guest-layout>

  <div class="user-acount product-detail">

    @livewire('header')

    <div class="main-content">
      <div class="wrap-banner">

        <x-breadcrumb :navs="[
          ['title' => 'Home', 'url' => route('home')],
          ['title' => 'My Account', 'url' => route('account')],
        ]" />

        <div class="acount head-acount">
          <div class="container">
            <div class="myaccount-page-wrapper mb-5">
              <div class="row">
                <div class="col-lg-3">
                  <div class="myaccount-tab-menu nav" role="tablist">
                    <a href="#account-info" class="active" data-toggle="tab">
                      <i class="fa fa-user"></i> {{ __('Account Details') }}
                    </a>
                    <a href="#address" data-toggle="tab">
                      <i class="fa fa-map-marker"></i> {{ __('Address') }}
                    </a>
                    <a href="#orders" data-toggle="tab">
                      <i class="fa fa-cart-arrow-down"></i> {{ __('Orders') }}
                    </a>
                    {{-- <a href="#payment-method" data-toggle="tab">
                      <i class="fa fa-credit-card"></i> {{ __('Payment Method') }}
                    </a> --}}
                  </div>
                </div>

                <div class="col-lg-9 mt-5 mt-lg-0">
                  <div class="tab-content" id="myaccountContent">

                    <div class="tab-pane fade show active" id="account-info" role="tabpanel">
                      <div class="myaccount-content">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                          <h1 class="h3 mb-0 text-gray-800">{{ __('Account Details') }}</h1>
                        </div>

                        <div>
                          @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                          @livewire('profile.update-profile-information-form')

                          <x-jet-section-border />
                          @endif

                          @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                          @livewire('profile.update-password-form')

                          <x-jet-section-border />
                          @endif

                          @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                          @livewire('profile.two-factor-authentication-form')

                          <x-jet-section-border />
                          @endif

                          @livewire('profile.logout-other-browser-sessions-form')

                          {{-- @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                          <x-jet-section-border />

                          @livewire('profile.delete-user-form')
                          @endif --}}
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="address" role="tabpanel">
                      @livewire('address')
                    </div>

                    <div class="tab-pane fade" id="orders" role="tabpanel">
                      @livewire('order')
                    </div>

                    {{-- <div class="tab-pane fade" id="payment-method" role="tabpanel">
                      @livewire('payment')
                    </div> --}}

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <x-footer />



    <x-back-top />

  </div>

</x-guest-layout>
