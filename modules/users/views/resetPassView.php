<?php
get_header("account");  
?>

<div class="container" id="container">
    <a class="btn-home icon" href="trang-chu"><i class="fa-solid fa-house"></i></a>
    <div class="form-container sign-in">
        <form method="POST">
            <h1>Bạn quên mật khẩu?</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <span>Nhập email của bạn để đặt lại mật khẩu</span>
            <input type="email" name="email" placeholder="Email" id="emailInput">
            <?php echo form_error('email'); ?>
            <?php echo form_error('account'); ?>
            <button id="confirm-btn" name="btn-confirm" type="submit">Xác nhận</button>
        </form>
    </div>
    <div class="toggle-container" id="toggleContainer">
        <div class="toggle">
            <div class="toggle-panel toggle-right" id="toggleLeft">
                <h1>Chào bạn!</h1>
                <p>Chỉ còn vài bước nữa thôi!</p>
                <p>Hãy trở lại và cùng tận hưởng</p>
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
    const container = document.getElementById('container');
    const confirmBtn = document.getElementById('confirm-btn');
    const emailInput = document.getElementById('emailInput');
    const toggleContainer = document.getElementById('toggleContainer');
    const toggleLeft = document.getElementById('toggleLeft');
    const loadingBox = document.getElementById('loadingBox');
    // Lấy biến từ php (isCheckemailvalid.php)
    document.getElementById("confirm-btn").addEventListener("click", () => {
        const userEmail = document.getElementById("emailInput").value;

        if (userEmail.trim() === "") {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Vui lòng không để trống",
            });
        } else {
            // Ẩn toggle-panel và hiện loading box
            toggleLeft.classList.add("active-hidden");
            loadingBox.classList.remove("active-hidden");

            // Sau khoảng thời gian chờ 3 giây ẩn loading box và hiện lại toggle-panel
            setTimeout(() => {
                loadingBox.classList.add("active-hidden");
                toggleLeft.classList.remove("active-hidden");
                //Kiểm tra giá trị isSuccess là true hay false
                if (false) { // Thay điều kiện bằng !isSuccess
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Email chưa được đăng ký!",
                    });
                } else {
                    Swal.fire({
                        icon: "success",
                        title: "Tuyệt",
                        text: "Vui lòng kiểm tra email để được xác thực"
                    });
                }
                // Hiển thị thông báo sau 3 giây

            }, 3000);
        }
    });
</script> -->

<?php
get_footer("account");
?>