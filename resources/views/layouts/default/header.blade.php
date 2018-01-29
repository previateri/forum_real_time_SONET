<ul id="locale" class="dropdown-content">
    <li><a href="/locale/pt-br">Português</a></li>
    <li><a href="/locale/en">Inglês</a></li>
</ul>
<div class="parallax-container">
    <nav>
        <div class="nav-wrapper black">
            <div class="container yellow-text">
                <a href="{{ route('home') }}" class="brand-logo">{{__('My Heroes - Forum')}}</a>
                <ul class="right">
                    <li>
                        <a href="#!" data-activates="locale" data-beloworigin="true" data-hover="true" class="dropdown-button">{{ __('Language') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="parallax">
        <img src="{{asset('img/help.jpg')}}" alt="">
    </div>
</div>