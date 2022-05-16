<div class="section deal-of-day">
    <div class="container">
        <div class="row">
            <div class="new-arrivals prodcut-tab col">
                <div id="contact-us">
                    <div class="title-tab-content product-tab">
                        <div class="title-product text-center">
                            <h2>{{ __('Contact Us') }}</h2>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        </div>
                    </div>
                    <div class="row-inhert mt-5">
                        <div class="header-contact">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="item d-flex">
                                        <div class="item-left">
                                            <div class="icon">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                        </div>
                                        <div class="item-right d-flex">
                                            <div class="title">Email:</div>
                                            <div class="contact-content">
                                                <a href="mailto:support@domain.com">{{ $email }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="item d-flex">
                                        <div class="item-left">
                                            <div class="icon">
                                                <i class="zmdi zmdi-home"></i>
                                            </div>
                                        </div>
                                        <div class="item-right d-flex">
                                            <div class="title">Address:</div>
                                            <div class="contact-content">{{ $address }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="item d-flex justify-content-end  last">
                                        <div class="item-left">
                                            <div class="icon">
                                                <i class="zmdi zmdi-phone"></i>
                                            </div>
                                        </div>
                                        <div class="item-right d-flex">
                                            <div class="title">Hotline:</div>
                                            <div class="contact-content">{{ $phone }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contact-map">
                            <div class="map">
                                <iframe src="{{ $map }}" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="input-contact">
                            <p class="text-intro text-center">{{ $short }}</p>

                            <p class="icon text-center">
                                <a href="#">
                                    <img src="{{ asset('storage/images/others/contact_mess.png') }}" alt="img">
                                </a>
                            </p>

                            <div class="d-flex justify-content-center">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="contact-form">
                                        <form wire:submit.prevent="send">
                                            <div class="form-fields">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <x-jet-input id="form.name" type="text" class="{{ $errors->has('form.name') ? 'is-invalid' : '' }}" wire:model="form.name" placeholder="Your name" />
                                                        <x-jet-input-error for="form.name" />
                                                    </div>
                                                    <div class="col-md-6 margin-bottom-mobie">
                                                        <x-jet-input id="form.email" type="email" class="{{ $errors->has('form.email') ? 'is-invalid' : '' }}" wire:model="form.email" placeholder="Your email" />
                                                        <x-jet-input-error for="form.email" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12 margin-bottom-mobie">
                                                        <x-jet-input id="form.subject" type="text" class="{{ $errors->has('form.subject') ? 'is-invalid' : '' }}" wire:model="form.subject" placeholder="Subject" />
                                                        <x-jet-input-error for="form.subject" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <textarea id="form.message" type="text" class="{{ $errors->has('form.message') ? 'is-invalid' : '' }} form-control form-control-user rounded-sm" wire:model="form.message" placeholder="Message" rows="8"></textarea>
                                                        <x-jet-input-error for="form.message" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <x-jet-button class="text-center" wire:loading.attr="disabled">
                                                    {{ __('Send message') }}
                                                </x-jet-button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <x-feedback-modal wire:model="feedbackModal">
                            <x-slot name="title">
                                {{ __('Message send successfully') }}
                            </x-slot>

                            <x-slot name="content">
                                <div class="row">
                                    <div class="col-sm-10 offset-sm-1 text-center">
                                        <p class="icon-addcart">
                                            <span><i class="fas fa-check"></i></span>
                                        </p>
                                        <h6 class="mb-4">{{ __('Thank you for your message. We will contact you soon.') }}</h6>
                                    </div>
                                </div>
                            </x-slot>
                        </x-feedback-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
