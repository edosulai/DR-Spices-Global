<div class="section product-living-room">
    <div class="container">
        <div class="row">
            <div class="new-arrivals product-tab col">
                <div class="tab-content" id="product-exhibition">
                    <div class="title-tab-content product-tab justify-content-between">
                        <div class="title-product">
                            <h2>{{ __('Our Product') }}</h2>
                            <p>{{ __('LOREM IPSUM DOLOR SIT AMET CONSECTETUR') }}</p>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active show">
                            <div class="category-product owl-carousel" wire:ignore>
                                @foreach ($spices as $spice)
                                    <div class="item text-center">
                                        <div class="product-miniature item-one first-item">
                                            <div class="thumbnail-container">
                                                <a href="{{ url(str_replace(' ', '-', $spice->nama)) }}">
                                                    <img class="img-fluid" src="{{ asset("storage/images/product/$spice->image") }}" alt="img">
                                                </a>
                                                {{-- <div class="product-flags discount">-30%</div> --}}
                                            </div>
                                            <div class="product-description">
                                                <div class="product-groups">
                                                    <div class="product-title">
                                                        <a href="{{ url(str_replace(' ', '-', $spice->nama)) }}">{{ $spice->nama }}</a>
                                                    </div>
                                                    <div class="rating">
                                                        <div class="star-content">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                <div class="star{{ $i < $spice->rating_avg ? '' : ' hole' }}"></div>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="product-group-price">
                                                        <div class="product-price-and-shipping">
                                                            <span class="price">{{ currency($spice->hrg_jual) }} <small>({{ $spice->unit }})</small></span>
                                                            {{-- <del class="regular-price">£28.68</del> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-buttons d-flex justify-content-center">
                                                    <button type="button" class="add-to-cart" wire:click="addToCart('{{ $spice->id }}')">
                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    </button>

                                                    <button type="button" class="quick-view hidden-sm-down" wire:click="detailSpice('{{ $spice->id }}')">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-feedback-cart wire:model="feedbackCartAddModal" :maxWidth="'lg'" :modal="$modal" />
    <x-detail-cart wire:model="detailModal" :maxWidth="'lg'" :modal="$modal" />

    <x-feedback-modal wire:model="warningModal" :maxWidth="'sm'" :icon="'fas fa-times'">
        <x-slot name="title">
            {{ $status_message }}
        </x-slot>

        <x-slot name="content">
            <ul class="list-group list-group-flush">
                @foreach ($validation_messages as $messages)
                    <li class="list-group-item pl-0"><i>{{ $messages }}</i></li>
                @endforeach
            </ul>
        </x-slot>
    </x-feedback-modal>

</div>
