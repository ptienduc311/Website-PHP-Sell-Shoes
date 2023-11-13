<?php
get_header("account");
?>

<script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                title: "Xác nhận thành công!",
                text: "Đổi mật khẩu ngay!",
                icon: "success",
                showCancelButton: false,
                confirmButtonText: "OK",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Đường dẫn gắn vào nút OK
                    const url = "?mod=member"; // Thay thế bằng đường dẫn đến trang getPassword
                    window.location.href = url;
                }
            });
        });
    </script>

<?php
get_footer("account");
?>