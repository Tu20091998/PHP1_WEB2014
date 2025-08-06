
    //js kiểm tra tính hợp lệ của form
    document.querySelector(".forgot-form").addEventListener("submit",function(e){

        //lấy dữ liệu từ form
        const email = document.getElementById("email").value.trim();
        const oldPassword = document.getElementById("old_password").value.trim();
        const newPassword = document.getElementById("new_password").value.trim();

        const errorDiv = document.getElementById("forgot-error");

        const errors = [];

        // Kiểm tra định dạng email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            errors.push("Email không hợp lệ.");
        }

        // Kiểm tra mật khẩu không được bỏ trống
        if (!oldPassword || !newPassword) {
            errors.push("Không được để trống mật khẩu.");
        }

        // Kiểm tra mật khẩu mới khác mật khẩu cũ
        if (oldPassword && newPassword && oldPassword === newPassword) {
            errors.push("Mật khẩu mới phải khác mật khẩu cũ.");
        }

        // Nếu có lỗi, ngăn submit và báo lỗi
        //hiển thị lỗi nếu có
        if(errors.length > 0){
            e.preventDefault(); // ngăn form gửi mặc định

            errorDiv.innerHTML = errors.join("<br>");
        }
        else{
            //gửi form đi và xoá lỗi
            errorDiv.innerHTML = "";
        }
    });