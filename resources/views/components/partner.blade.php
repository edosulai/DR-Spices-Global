<div class="container">
    
    <div class="section introduct-logo">
        <div class="row">
            <div class="tiva-manufacture  col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="block">
                    <div id="manufacture" class="owl-carousel owl-theme owl-loaded owl-drag">
                        @foreach ($partner_logos as $partner_logo)
                        <div class="item">
                            <div class="logo-manu">
                                <img class="img-fluid" src="{{ $partner_logo }}" alt="img" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>