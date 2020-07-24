@extends('index')
@section('index-content')
<!-- stat search -->
@include('layouts._share.search-home')
<!-- end search -->
<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <img src="img/language.png" alt="">
            <div>English</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">Spanis</a></li>
                <li><a href="#">English</a></li>
            </ul>
        </div>
        <div class="header__top__right__auth">
            <a href="#"><i class="fa fa-user"></i> Login</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="./index.html">Home</a></li>
            <li><a href="./shop-grid.html">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="./blog.html">Blog</a></li>
            <li><a href="./contact.html">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->

<section class="shoping-cart spad" id="cart-warrper">
    @include('components.cart-components')
</section>

<!-- Shoping Cart Section End -->

<!-- Footer Section Begin -->

<!-- Footer Section End -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function cartUpdate(event) {
        event.preventDefault();
        let urlUpdateCart = $('.update_cart_url').data('url');
        var idProduct = [];
        var dataQuantity = [];
        $('.update_quantity').each(function() {
            dataQuantity.push($(this).find('input').val());
            console.log('log');
        });
        $('.id').each(function() {
            idProduct.push($(this).data('id'));
        });
        $.ajax({
            type: "GET",
            url: urlUpdateCart,
            data: {
                id: idProduct,
                quantity: dataQuantity
            },
            success: function(data) {
                if (data.alert === 300) {
                    alert('nhập số lượng');
                }
                if (data.code === 200) {
                    $('#cart-warrper').html(data.cart_components);
                    alert('Cập Nhập Số lượng Thành Công');
                }
            },
            error: function() {

            }
        });
    }

    function cartDelete(event) {
        event.preventDefault();
        let urlDelete = $('.table-responsive').data('url');
        let id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: urlDelete,
            data: {
                id: id
            },
            success: function(data) {


                if (data.code === 200) {

                    $('#cart-warrper').html(data.cart_components);
                    alert('Xóa Sản Phẩm Khỏi Giỏ Hàng Thành Công');
                }
            },
            error: function() {

            }
        });
    }

    $(function() {
        $(document).on('click', '.cart_update', cartUpdate)
        $(document).on('click', '.cart_delete', cartDelete)
    })
</script>

@endsection