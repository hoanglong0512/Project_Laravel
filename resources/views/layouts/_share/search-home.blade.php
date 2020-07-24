<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul style="display: none;">
                        @foreach($cates as $cate)
                        <li><a href="#">{{$cate->name}}</a></li>

                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="search" name="search" id="search" placeholder="Bạn Muốn Tìm gì ?" aria-label="Search">

                            <!-- <button type="submit" class="site-btn">SEARCH</button> -->


                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <!-- box tìm kiếm -->
                <div id="box-search" class="shadow bg-white rounded">

                </div>
                <!-- end box tìm kiếm -->
                
            </div>
        </div>
    </div>
</section>