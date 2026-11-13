$(function() {
    $('.addtocart').on('submit', function() {
        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: 'post',
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    $('.mini-cart-qty').text(result.cart_qty);
                }
            },
            error: function (msg) {
                alert("Error");
                console.log(msg.responseJSON);
            }
        });
        return false;
    });

    $('#cart-modal .modal-body').on('click', '.del-item', function() {
        $.ajax({
            url: $(this).data('action'),
            type: 'get',
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    $('#cart-modal .modal-body').html(result.html);
                    $('.mini-cart-qty').text(result.cart_qty);
                }
            },
            error: function (msg) {
                alert('Error');
            }
        });
    });
    
    $(document).on('click', '.clear-cart', function() {
        let action = $(this).data('action');
        $.ajax({
            url: action,
            type: 'get',
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    $('#cart-modal .modal-body').html(result.html);
                    $('.mini-cart-qty').text(result.cart_qty);
                }
            },
            error: function () {
                alert('Error');
            }
        });
    });
});

function showCart(cart) {
    $('#cart-modal .modal-body').html(cart);
    $('#cart-modal').modal();
    let cartQty = $('#modal-cart-qty').text() ? $('#modal-cart-qty').text() : 0;
    $('.mini-cart-qty').text(cartQty);
    if (cartQty) {
        $('#cart-modal .modal-footer button.btn-cart').removeClass('d-one');
    } else {
        $('#cart-modal .modal-footer button.btn-cart').addClass('d-one');
    }
}

function getCart(action) {
    $.ajax({
        url: action,
        type: 'get',
        success: function (result) {
            let now_location = document.location.pathname;
            if (now_location == '/cart/checkout') {
                location = '/cart/checkout';
            } else {
                showCart(result);
            }
        },
        error: function() {
            alert('Error');
        }
    });
}