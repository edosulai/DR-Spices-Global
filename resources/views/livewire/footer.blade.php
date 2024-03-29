<footer class="footer-one">
    <div class="inner-footer">
        <div class="container">
            <div class="footer-top col-lg-12 col-xs-12">
                <div class="row">
                    <div class="dr-html col-lg-4 col-md-12 col-xs-12">
                        <div class="block">
                            <div class="block-content">
                                <a href="{{ route('home') }}" class="logo-footer">
                                    <img class="img-fluid w-55 mb-2" src="{{ $logo }}">
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
                    <div class="dr-html col-lg-4 col-md-6">
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
                    <div class="dr-modules col-lg-4 col-md-6">
                        <div class="block m-top">
                            <div class="block-content">
                                <div class="title-block">{{ __('Newsletter') }}</div>
                                <div class="sub-title">{{ $newsletter }}</div>
                                <div class="block-newsletter">
                                    <form wire:submit.prevent="send">
                                        <div class="input-group">
                                            <input type="text" class="form-control {{ $errors->has('form.email') ? 'is-invalid' : '' }}" wire:model="form.email" placeholder="Enter Your Email">
                                            <span class="input-group-btn">
                                                <button class="effect-btn btn btn-secondary" type="submit">
                                                    <span>{{ __('subscribe') }}</span>
                                                </button>
                                            </span>
                                            <x-jet-input-error for="form.email" />
                                        </div>
                                    </form>
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
                                    <div class="d-flex">
                                        @foreach ($payments as $payment)
                                            <img class="w-15" src="{{ $payment }}">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-feedback-modal wire:model="feedbackModal">
        <x-slot name="title">
            {{ __('Subscribe successfully') }}
        </x-slot>

        <x-slot name="content">
            <div class="row">
                <div class="col-sm-10 offset-sm-1 text-center">
                    <p class="icon-addcart">
                        <span><i class="fas fa-check"></i></span>
                    </p>
                    <h6 class="mb-4">{{ __('You have successfully subscribed to the latest news from us') }}</h6>
                </div>
            </div>
        </x-slot>
    </x-feedback-modal>
</footer>
