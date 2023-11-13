$(document).ready(function () {
    $(".filter").click(function () {
        // Lấy giá trị của radio và checkbox được chọn
        var price = $("input[name='price']:checked").val();
        var brands = $("input[name='brand']:checked").map(function () {
            return this.value;
        }).get();
        console.log(price);
        console.log(brands);
        $.ajax({
            url: '?mod=product&action=index', // Đường dẫn đến file xử lý Ajax trên server
            method: 'POST',
            data: {
                price: price,
                brands: brands
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
        return false;
    });
})