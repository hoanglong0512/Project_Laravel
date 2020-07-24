<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            @if(Auth::check())
                            <li><i class="fa fa-envelope"></i>{{Auth::user()->email}}</li>
                            @else
                            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>

                            @endif

                            <li>Free Shipping for all Order of $99</li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="{{ trans('message.welcome') }}">English</a></li>
                                <li><a href="{{ trans('message.welcome') }}">Việt Nam</a></li>
                            </ul>
                        </div>
                        <div class="header__top__right__auth">
                            @if(Auth::check())
                            <a href="#"><i class="fa fa-user-circle"></i>{{Auth::user()->name}}</a>
                            <a href="{{route('logout')}}"><i class='fa fa-sign-out'></i>loguot</a>
                            @else
                            <a href="{{route('login')}}"><i class="fa fa-user"></i>Login</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{route('home')}}"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('shop.grid')}}">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">

                                <li><a href="{{route('detail')}}">Shop Details</a></li>
                                <li><a href="{{route('shoping.cart')}}">Shoping Cart</a></li>
                                <li><a href="{{route('check.out')}}">Check Out</a></li>
                                <li><a href="{{route('blog.details')}}">Blog Details</a></li>
                            </ul>

                        </li>
                        <li><a href="{{route('blog')}}">Blog</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>

                    </ul>
                </nav>
            </div>
            <div class="col-lg-3" id="cartCount">
                <div class="header__cart">
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="{{route('shoping.cart')}}"><i class="fa fa-shopping-bag"></i><span>

                                </span></a></li>
                    </ul>
                    <div class="header__cart__price">item: <span>$150.00</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>

        </div>
    </div>
</header>