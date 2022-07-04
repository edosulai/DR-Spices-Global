<div class="tab-content">
    <div class="tab-pane fade in active show">
        <div class="category-product owl-carousel" wire:ignore>
            @foreach ($maggots as $maggot)
                <div class="item text-center">
                    <div class="product-miniature item-one first-item">
                        <div class="thumbnail-container">
                            <a href="{{ url(str_replace(' ', '-', $maggot->nama)) }}">
                                <img class="img-fluid" src="{{ asset("storage/images/products/$maggot->image") }}" alt="img">
                            </a>
                            {{-- <div class="product-flags discount">-30%</div> --}}
                        </div>
                        <div class="product-description">
                            <div class="product-groups">
                                <div class="product-title">
                                    <a href="{{ url(str_replace(' ', '-', $maggot->nama)) }}">{{ $maggot->nama }}</a>
                                </div>
                                <div class="rating">
                                    <div class="star-content">
                                        @for ($i = 0; $i < 5; $i++)
                                            <div class="star{{ $i < $maggot->rating_avg ? '' : ' hole' }}"></div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="product-group-price">
                                    <div class="product-price-and-shipping">
                                        <span class="price">{{ currency($maggot->hrg_jual) }} <small>({{ $maggot->unit }})</small></span>
                                        {{-- <del class="regular-price">£28.68</del> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="product-buttons d-flex justify-content-center">
                                <button type="button" class="add-to-cart" wire:click="addToCart('{{ $maggot->id }}')">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </button>

                                <button type="button" class="quick-view hidden-sm-down" wire:click="detailMaggot('{{ $maggot->id }}')">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
