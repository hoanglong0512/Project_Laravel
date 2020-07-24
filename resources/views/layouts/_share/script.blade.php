<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function addToCart(event) {
        event.preventDefault();
        let urlCart = $(this).data('url');

        $.ajax({
            type: "GET",
            url: urlCart,
            dataType: 'json',
            success: function(data) {
                if (data.code === 200) {
                    alert('Thêm sản phẩm thành công');
                    //$('#cartCount').html(data.cartCount);
                }
            },
            error: function() {

            }
        });


    }
    $(function() {

        $('.add_to_cart').on('click', addToCart)
    });
</script>


<script type="text/javascript">
    $('#search').on('keyup', function(event) {
        $value = $(this).val(); // nhận dữ liệu từ input
        console.log($value);
        $.ajax({
            type: 'get',
            url: "{{route('search-index')}}",
            data: {
                'search': $value
            },
            success: function(data) {
                $('#box-search').html(data);
            }
        });
    })
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
</script>