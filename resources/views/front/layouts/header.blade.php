    <style>
        .dark-mode{
            background-image: url('https://1is.butagrup.az/back/assets/images/icons/dark.png');
            background-size: cover;
            background-position: center;
            width: 30px;
            height: 30px;
            }

        .dark .dark-mode {
            background-image: url("https://1is.butagrup.az/back/assets/images/icons/light.png");
            background-size: cover;
            background-position: center;
            width: 30px;
            height: 30px;
            }

            .header-logo img {
                width: 74px;
                height: 68px;
            }
    </style>
<header>
    <nav>
        <div class="header-logo">
            <div class="ham-menu">
                <input class="checkbox" type="checkbox" name="" id="" />
                <div class="hamburger-lines">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
                </div> 
            </div>
            <a href="{{route('index')}}"><img src="{{ asset($setting->logo) }}" alt=""></a>
        </div>


        <div class="darkLight-searchBox">
        <div class="header-right-side">
            <div class="menu-items">
                <ul>
                    <li><a href="{{route('allvacancies')}}">@lang('front.vacancies')</a></li>
                    <li><a href="{{route('jobsearch')}}">@lang('front.jobsearch')</a></li>
                    <li><a href="{{route('allcompany')}}">@lang('front.companies')</a></li>
                    <li><a href="{{route('trainings')}}">@lang('front.training')</a></li>
                    <li><a href="{{route('allblogs')}}">@lang('front.blog')</a></li>
                    <li><a href="https://employment.az/">Employment</a></li>
                    
                </ul>
            </div>
            <div class="lang-div">
                <div class="dropdown">
                    <div class="select">
                        <span class="selected">{{ app()->getLocale() }}</span>
                        <div class="caret"></div>
                    </div>
                    <ul class="menu">
                        <a href="/AZ" style="color: #ffff" class="{{ app()->getLocale() === 'AZ' ? 'selected' : '' }}"><li>AZ</li></a>
                        <a href="/EN" style="color: #ffff" class="{{ app()->getLocale() === 'EN' ? 'selected' : '' }}"><li>EN</li></a>
                        <a href="/RU" style="color: #ffff" class="{{ app()->getLocale() === 'RU' ? 'selected' : '' }}"><li>RU</li></a>
                        <a href="/TR" style="color: #ffff" class="{{ app()->getLocale() === 'TR' ? 'selected' : '' }}"><li>TR</li></a>

                    </ul>
                </div>
                
                
                  
                <div class="dark-mode"></div>
                    @auth
                        <a href="{{ route('profile') }}" style="background-color: transparent;">
                            <img src="https://1is-new.netlify.app/images/profile.png" alt="">
                        </a>
                    @else
                        <a href="{{ route('login') }}" style="background-color: transparent;">
                            <img src="https://1is-new.netlify.app/images/profile.png" alt="">
                        </a>
                    @endauth
                

            </div>

            </div>

        </div>
        </div>
    </nav>
  </header>
