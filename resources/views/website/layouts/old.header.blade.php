<div class="header">

    <div class="menu flex justify-between items-center">

        <!-- Website logo div-->
        <div class="logo">
            <a href="{{ route('main-home') }}"><img src="{{ asset ('website')}}/img/pappu.png" class="brang-logo" alt="" srcset=""></a>
        </div>

        <!-- Menu itesms div-->

        <div class="menu-items list-none">

            <div class="phone-menu">
                <a href="#" id="icon-menu"><i class="fa fa-bars"></i></a>
            </div>

            <nav class="nav-menu">

                <li>
                <router-link :to="{name: 'home'}">Home</router-link>
                </li>
                <li>
                    <a href="#service"> <i class="fab fa-app-store-ios header-icons"></i> <span> Services</span></a>
                </li>
                <li>
                    <a href="#"> <i class="fa fa-book header-icons"></i> <span>Portfolio</span> </a>
                </li>
                <li>
                <router-link :to="{name: 'public-post'}">Blogs</router-link>
                </li>
                <li>
                    <a href="#about"> <i class="fa fa-user header-icons"></i> <span>About</span> </a>
                </li>

                <li>
                    <a href="#contact"> <i class="fa fa-address-book header-icons"></i> <span>Contact</span> </a>
                </li>
                <li>
                @guest
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif

                    @endguest
                </li>
                <li>
                @guest
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @endguest
                </li>
                <li class="">
                    @guest
                    @else
                <li class="">
                <router-link :to="{name: 'user-all-post'}">Dashboard</router-link>
                </li>
                @endguest
                </li>
            </nav>

        </div>

    </div>
</div>
