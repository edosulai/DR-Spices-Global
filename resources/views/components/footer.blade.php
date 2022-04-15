@props(['short','newsletter','address','phone','email','opening','navs'])

<footer class="footer-one">
  <div class="inner-footer">
    <div class="container">
      <div class="footer-top col-lg-12 col-xs-12">
        <div class="row">
          <div class="tiva-html col-lg-4 col-md-12 col-xs-12">
            <div class="block">
              <div class="block-content">
                <a href="{{ route('home') }}" class="logo-footer">
                    {{-- <x-jet-application-mark width="36" class="text-black" /> --}}
                    {{-- <span class="text-truncate h5 ml-3">{{ config('app.name', 'Laravel') }}</span> --}}
                    <img src="{{ $logo }}" alt="img">
                </a>
                <p class="content-logo">{{ $short }}</p>
              </div>
            </div>
            <div class="block">
              <div class="block-content">
                <ul>
                  @foreach ($navs as $nav)
                  <li>
                    <a href="{{ $nav['url'] }}">{{ $nav['name'] }}</a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          <div class="tiva-html col-lg-4 col-md-6">
            <div class="block m-top">
              <div class="title-block">
                Contact Us
              </div>
              <div class="block-content">
                <div class="contact-us">
                  <div class="title-content">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Address :</span>
                  </div>
                  <div class="content-contact address-contact">
                    <p>{{ $address }}</p>
                  </div>
                </div>
                <div class="contact-us">
                  <div class="title-content">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <span>Email :</span>
                  </div>
                  <div class="content-contact mail-contact">
                    <p>{{ $email }}</p>
                  </div>
                </div>
                <div class="contact-us">
                  <div class="title-content">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span>Hotline :</span>
                  </div>
                  <div class="content-contact phone-contact">
                    <p>{{ $phone }}</p>
                  </div>
                </div>
                <div class="contact-us">
                  <div class="title-content">
                    <i class="fas fa-clock" aria-hidden="true"></i>
                    <span>Opening Hours :</span>
                  </div>
                  <div class="content-contact hours-contact">
                    <p>{{ $opening[0] }}</p>
                    <span>{{ $opening[1] }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tiva-modules col-lg-4 col-md-6">
            <div class="block m-top">
              <div class="block-content">
                <div class="title-block">{{ __('Newsletter') }}</div>
                <div class="sub-title">{{ $newsletter }}</div>
                <div class="block-newsletter">
                  <div class="input-group">
                    <input type="text" class="form-control" name="email" value="" placeholder="Enter Your Email">
                    <span class="input-group-btn">
                      <button class="effect-btn btn btn-secondary " name="submitNewsletter" type="submit">
                        <span>{{ __('subscribe') }}</span>
                      </button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="block m-top1">
              <div class="block-content">
                <div class="social-content">
                  <div class="title-block">{{ __('Follow us on') }}</div>
                  <div class="social-block">
                    <div class="social">
                      <ul class="list-inline mb-0 justify-content-end">
                        @foreach ($medsoses as $medsos)
                        <li class="list-inline-item mb-0">
                          <a href="{{ $medsos['url'] }}" target="_blank">
                            <i class="{{ $medsos['icon'] }}"></i>
                          </a>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="block m-top1">
              <div class="block-content">
                <div class="payment-content">
                  <div class="title-block">{{ __('Payment accept') }}</div>
                  <div class="payment-image">
                    <img class="img-fluid" src="{{ $payment }}" alt="img">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
