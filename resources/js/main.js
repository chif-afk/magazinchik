$ (function() {
    $('.addtocart').on('submit', function() {
        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: 'post',
            success: function (result) {
                console.log(result);
            },
            error: function (msg) {
                alert("Error");
                console.log(msg.responseJSON);
                form[0].reset();
            }
        });
        return false;
    })
})