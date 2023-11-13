<?php
get_header("account");
?>

<div class="container" id="container">
        <a class="btn-home icon" href="?mod=home"><i class="fa-solid fa-house"></i></a>
        <div class="form-container sign-in">
            <form method="POST">
                <h1>Mật khẩu mới</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Hãy đặt mật khẩu mới an toàn!</span>
                <input type="password" name="newPassword" placeholder="Mật khẩu mới" id="passInput">
                <input type="password" name="confirmPassword" placeholder="Nhập lại mật khẩu mới" id="repassInput">
                <?php echo form_error('password'); ?>
                <?php echo form_error('code'); ?>
                <button id="confirm-btn" name="btn-confirm" type="submit">Xác nhận</button>
            </form>
        </div>
        <div class="toggle-container" id="toggleContainer">
            <div class="toggle">
                <div class="toggle-panel toggle-right" id="toggleLeft">
                    <h1>Chào mừng trở lại!</h1>
                    <p>Mật khẩu với độ bảo mật cao đem lại<br> sự an toàn cho bạn và chúng tôi</p>
                    <p>Cảm ơn bạn đã luôn tin tưởng chúng tôi</p>
                </div>
                <div class="loading-box toggle-right active-hidden" id="loadingBox">
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        const confirmBtn = document.getElementById("confirm-btn");
        confirmBtn.addEventListener("click", () => {
            const userPass = document.getElementById("passInput").value;
            const userRePass = document.getElementById("repassInput").value;
        
            if (userPass.trim() === "" || userRePass.trim() === "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Vui lòng không để trống!",
                showCancelButton: true,
            });
            } else {
            // Ẩn toggle-panel và hiện loading box
            toggleLeft.classList.add("active-hidden");
            loadingBox.classList.remove("active-hidden");
        
            // Sau khoảng thời gian chờ 3 giây ẩn loading box và hiện lại toggle-panel
            setTimeout(() => {
                loadingBox.classList.add("active-hidden");
                toggleLeft.classList.remove("active-hidden");
        
                // Hiển thị thông báo sau 3 giây
                Swal.fire({
                title: "Xác nhận thành công!",
                text: "Đổi mật khẩu ngay!",
                icon: "success",
                showCancelButton: false,
                confirmButtonText: "OK",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Đường dẫn gắn vào nút OK
                    const url = "success.html"; // Thay thế bằng đường dẫn đến trang chủ
                    window.location.href = url;
                }
            });
            }, 3000);
            }
        });
    </script> -->

<?php
get_footer("account");
?>