@props(['navs'])

<nav class="breadcrumb-bg">
    <div class="container no-index">
        <div class="breadcrumb">
            <ol>
                @foreach ($navs as $nav)
                <li>
                    <a href="{{ $nav['url'] }}">
                        <span>{{ $nav['title'] }}</span>
                    </a>
                </li> 
                @endforeach
            </ol>
        </div>
    </div>
</nav>