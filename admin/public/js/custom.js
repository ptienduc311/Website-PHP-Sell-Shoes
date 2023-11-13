// $(function(){
//     $("#upload_single_bt").hover(function() {
//         console.log("Click");uploadFile
//     })
// })

$(function () {
    var inputFile = $('#file');
    $('#upload_single_bt').click(function (event) {
        var URI_single = $('#form-upload-single #file').attr('data-uri');
        var fileToUpload = inputFile[0].files[0];
        var formData = new FormData();
        formData.append('file', fileToUpload);
        $.ajax({
            url: URI_single,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.status == 'ok') {
                    showThumbUpload(data);
                    $('#thumbnail_id').val(data.id_image);
                }
                if(data.status == 'error'){
                    showError(data);
                    console.log(data.error.file);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
        return false;
    });

    function  showThumbUpload(data) {
        var items;
        items = '<img src="' + data.file_path + '"/>';
        $('#show_list_file').html(items);
    }
    function showError(data){
        var items;
        items = '<p class = "error">' + data.error.file + '</p>';
        $('#show_list_file').html(items);
    }

});