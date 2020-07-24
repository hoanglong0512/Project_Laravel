<div class="row">
    @forelse($products as $pro)
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="{{$pro->image}}">
                <ul class="product__item__pic__hover">
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">{{$pro->name}}</a></h6>
                <h5>${{number_format($pro->price, 0, '.','.')}}</h5>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-success  text-light">
        <strong>Không Có Sản Phẩm Của Danh Mục Này !!!</strong>
    </div>
    @endforelse

</div>