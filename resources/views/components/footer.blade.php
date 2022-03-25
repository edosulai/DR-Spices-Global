@props(['short','newsletter','address','phone','email','opening','navs'])

<footer class="footer-one">
  <div class="inner-footer">
    <div class="container">
      <div class="footer-top col-lg-12 col-xs-12">
        <div class="row">
          <div class="tiva-html col-lg-4 col-md-12 col-xs-12">
            <div class="block">
              <div class="block-content">
                <p class="logo-footer">
                  <img src="{{ asset('storage/images/home/logo.png') }}" alt="img">
                </p>
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
            <div class="block">
              <div class="block-content">
                <p class="img-payment ">
                  <img class="img-fluid" src="{{ asset('storage/images/home/payment-footer.png') }}" alt="img">
                </p>
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
                <div class="title-block">Newsletter</div>
                <div class="sub-title">{{ $newsletter }}</div>
                <div class="block-newsletter">
                  <form action="#" method="post">
                    <div class="input-group">
                      <input type="text" class="form-control" name="email" value="" placeholder="Enter Your Email">
                      <span class="input-group-btn">
                        <button class="effect-btn btn btn-secondary " name="submitNewsletter" type="submit">
                          <span>subscribe</span>
                        </button>
                      </span>
                    </div>
                    <input type="hidden" name="action" value="0">
                  </form>
                </div>
              </div>
            </div>
            <div class="block m-top1">
              <div class="block-content">
                <div class="social-content">
                  <div class="title-block">
                    Follow us on
                  </div>
                  <div class="social-block">
                    <div class="social">
                      <ul class="list-inline mb-0 justify-content-end">
                        <li class="list-inline-item mb-0">
                          <a href="#" target="_blank">
                            <i class="fab fa-facebook"></i>
                          </a>
                        </li>
                        <li class="list-inline-item mb-0">
                          <a href="#" target="_blank">
                            <i class="fab fa-twitter"></i>
                          </a>
                        </li>
                        <li class="list-inline-item mb-0">
                          <a href="#" target="_blank">
                            <i class="fab fa-google"></i>
                          </a>
                        </li>
                        <li class="list-inline-item mb-0">
                          <a href="#" target="_blank">
                            <i class="fab fa-instagram"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="block m-top1">
              <div class="block-content">
                <div class="payment-content">
                  <div class="title-block">
                    Payment accept
                  </div>
                  <div class="payment-image">
                    <img class="img-fluid" src="{{ asset('storage/images/home/payment.png') }}" alt="img">
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