$(document).ready(function() {
    $("#upload_more_bt").on('click', function() {
        // var data = new FormData(this);
        var inputFile = $('#file');
        var fileToUpload = inputFile[0].files;
        var id_images;
        if (fileToUpload.length > 0) {
            // alert(fileToUpload.length);
            var formData = new FormData();
            for (var i = 0; i < fileToUpload.length; i++) {
                var file = fileToUpload[i];
                formData.append('file[]', file, file.name);
            }
            $.ajax({
                url: '?mod=image&action=uploadMore',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    id_images=data.id_image.join();
                    $("#show_list_file").html(data.result);
                    $('#thumbnail_id').val(id_images);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        }
        //alert('ok');
        return false;
    });
});