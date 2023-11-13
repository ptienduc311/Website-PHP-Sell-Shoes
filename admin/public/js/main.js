$(document).ready(function () {

    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

//  CHECK ALL
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

// EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });

//   UPLOAD ẢNH AJAX
$("#upload_info").on('submit', function() {
    // var data = new FormData(this);
    var inputFile = $('#file');
        var fileToUpload = inputFile[0].files;

        if (fileToUpload.length > 0) {
            var formData = new FormData();
            // Chỉ thêm một file vào formData
            formData.append('file', fileToUpload[0], fileToUpload[0].name);

            $.ajax({
                url: '?mod=post&action=process',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'text',
                success: function(data) {
                    $("#result").html(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }

        return false;
});
});