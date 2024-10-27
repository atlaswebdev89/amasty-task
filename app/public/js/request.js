$(document).ready(function (event) {
    $('#pizza-form').submit(function (e) {
        e.preventDefault();
        const data = $(this).serializeArray();
        const output = $('.order-status');
        $.ajax({
            type: 'POST',
            url: '/order',
            data: data,
            dataType: 'json',
            success: function (data) {
                output.empty();
                output.append('<div><h3>Your order</h3></div>');
                $.each(data, (index, elem) => {
                    output.append('<div>' + index + ': ' + elem + '</div>');
                });
                output.show();
            },
            error: function () {
                console.log('Error!');
            },
        });
    });
});