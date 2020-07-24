<div class="container table-responsive" data-url="{{route('cart.delete')}}">
    <div class="row update_cart_url" data-url="{{route('update.cart')}}">
        <div class="col-lg-12">
            <div class=" shoping__cart__table">
                @if(isset($_GET['msg']))
                <div class="alert alert-danger alert-dismissible fade show text-light">
                    <strong>{{$msg}}</strong>
                </div>
                @endif
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="shoping__product">Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total = 0;
                        @endphp
                        @forelse($carts as $id => $item)
                        @php
                        $total += $item['price'] *$item['quantity'];
                        @endphp
                        <tr>
                            <td class="id" data-id="{{$id}}">{{$id}}</td>
                            <td class="shoping__cart__item">
                                <img src="{{$item['image']}}" width="60">
                                <h5>{{$item['name']}}</h5>
                            </td>
                            <td class="shoping__cart__price">
                                {{number_format($item['price'])}} VNĐ
                            </td>
                            <td class="shoping__cart__quantity update_quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="{{$item['quantity']}}" min="1" data-val="{{$item['quantity']}}">
                                    </div>
                                </div>
                            </td>
                            <td class="shoping__cart__total">
                                {{number_format($item['price'] * $item['quantity'], 0, ',', '.')}} VNĐ
                            </td>
                            <td class="shoping__cart__item__close">

                                <a onclick=" return confirm('Bạn có chắc chắn xóa không');" data-id="{{$id}}" class="cart_delete">
                                    <span class="icon_close">
                                </a>
                                </span>
                            </td>
                        </tr>
                        <!-- @php   view()->share('layouts._share.header-home', 'data');@endphp
                        @php   view()->share('index', 'data');@endphp -->
                        @empty
                        <div class="alert alert-danger">KHÔNG CÓ SẢN PHẨM NÀO TRONG GIỎ HÀNG !!!</div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="shoping__cart__btns">
                <a href="{{route('home')}}" class="primary-btn cart-btn-primary">CONTINUE SHOPPING</a>

                <a href="#" class="primary-btn cart-btn cart-btn-right bg-info text-light cart_update">
                    Upadate Cart</a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="shoping__continue">
                <div class="shoping__discount">
                    <h5>Discount Codes</h5>
                    <form action="#">
                        <input type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">APPLY COUPON</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="shoping__checkout">
                <h5>Cart Total</h5>
                <ul>
                    <li>Subtotal <span>{{number_format($total, 0, ',', '.')}} VNĐ</span></li>
                    <li>Total <span>{{number_format($total, 0, ',', '.')}} VNĐ</span></li>
                </ul>
                <a href="{{route('check.out')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
            </div>
        </div>
    </div>
</div>