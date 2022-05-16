<div class="section deal-of-day">
    <div class="container">
        <div class="row">
            <div class="new-arrivals prodcut-tab col">
                <div id="about-us">
                    <div class="title-tab-content product-tab">
                        <div class="title-product text-center">
                            <h2>{{ __('About Us') }}</h2>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        </div>
                    </div>
                    <div class="row mt-5">
                        @foreach ($abouts as $key => $about)
                        @if ($key % 2 == 0)
                        <div class="col-lg-6 col-md-6 col-sm-6 right">
                            <img class="img-fluid" src="{{ $about['img_src'] }}" alt="#" width="100%" height="100%" />
                        </div>
                        @endif
                        <div class="col-lg-6 col-md-6 col-sm-6 {{ $key % 2 == 0 ? 'left' : 'right' }}">
                            <div class="cms-block {{ $key % 2 == 0 ? 'f-right' : 'f-left' }} ">
                                <h3 class="page-subheading">{{ $about['title'] }}</h3>
                                @foreach ($about['desc'] as $a)
                                <p>{{ $a }}</p>
                                @endforeach
                            </div>
                        </div>
                        @if ($key % 2 == 1)
                        <div class="col-lg-6 col-md-6 col-sm-6 left">
                            <img class="img-fluid" src="{{ $about['img_src'] }}" alt="#" width="100%" height="100%" />
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
