$ (function() {
    $('.addtocart').on('submit', function() {
        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: 'post',
            success: function (result) {
                if (result.success) {
                    $('.mini-cart-qty').text(result.cart_qty);
                }
            },
            error: function (msg) {
                alert("Error");
                console.log(msg.responseJSON);
                form[0].reset();
            }
        });
        return false;
    })

    $('#cart-modal .modal-body').on('click', '.del-item', function() {
        $.ajax({
            url: $(this).data('action'),
            type: 'get',
            success: function (result) {
                showCart(result);
            },
            error: function (msg) {
                alert('Error');
            }
        });
    });

           $(document).on('click', '.clear-cart', function() {
                let action = $(this).data('action');
                clearCart(action);
            });
})

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
            showCart(result);
        },
        error: function() {
            alert('Error');
        }
    })
}

function clearCart(action) {
    $.ajax({
        url: action,
        type: 'get',
        success: function (result) {
            showCart(result);
        },
        error: function() {
            alert('Error');
        }
    });

    
}

