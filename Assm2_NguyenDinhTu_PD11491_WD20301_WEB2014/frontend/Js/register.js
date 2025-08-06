    
    //js kiểm tra tính hợp lệ của form
    document.querySelector(".register-form").addEventListener("submit", function(e){

        //lấy dữ liệu từ các input
        const fullname = document.getElementById("fullname").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const gender = document.querySelector("input[name='gender']:checked");
        const birthdate = document.getElementById("birthdate").value;
        const address = document.getElementById("address").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirm_password").value.trim();

        //đưa lỗi ra màn hình
        const errorDiv = document.getElementById("register-error");
        let errors = [];

        //kiểm tra rỗng hay không ?
        if (!fullname) errors.push("Vui lòng nhập họ và tên.");
        if (!email) errors.push("Vui lòng nhập email.");
        if (!phone) errors.push("Vui lòng nhập số điện thoại.");
        if (!gender) errors.push("Vui lòng chọn giới tính.");
        if (!birthdate) errors.push("Vui lòng chọn ngày sinh.");
        if (!address) errors.push("Vui lòng nhập địa chỉ.");
        if (!password) errors.push("Vui lòng nhập mật khẩu.");
        if (!confirmPassword) errors.push("Vui lòng nhập lại mật khẩu.");

        
        // Email định dạng
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email)) errors.push("Email không đúng định dạng.");

        // Số điện thoại
        const phoneRegex = /^\d{9,11}$/;
        if (phone && !phoneRegex.test(phone)) errors.push("Số điện thoại phải là 9 đến 11 chữ số.");

        //ngày sinh không được lớn hơn ngày hôm nay
        const today = new Date().toISOString().split("T")[0];
        if (birthdate && birthdate > today) errors.push("Ngày sinh không hợp lệ.");

        // Mật khẩu
        if (password && password.length < 2) errors.push("Mật khẩu phải có ít nhất 2 ký tự.");
        if (password && confirmPassword && password !== confirmPassword) {
            errors.push("Mật khẩu xác nhận không khớp.");
        }

        // Hiển thị lỗi hoặc gửi
        if (errors.length > 0) {
            e.preventDefault(); // Chặn submit
            errorDiv.innerHTML = errors.join("<br>");
        } else {
            errorDiv.innerHTML = "";
            // Cho phép gửi bình thường
        }
    });