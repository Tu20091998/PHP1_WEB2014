    
    //js kiểm tra tính hợp lệ của form đăng nhập
    document.querySelector(".login-form").addEventListener("submit", function(e){
        //lấy dữ liệu từ form 
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const errorDiv = document.getElementById("login-error");

        let errors = [];

        //kiểm tra nếu giá trị trong form rỗng
        if(!email){
            errors.push("Vui lòng nhập email !");
        }

        if(!password){
            errors.push("Vui lòng nhập mật khẩu !");
        }

        //kiểm tra định dạng email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(email && !emailRegex.test(email)){
            errors.push("Email không đúng định dạng !");
        }

        //kiểm tra độ dài mật khẩu
        if(password && password.length < 2){
            errors.push("Mật khẩu phải có ít nhất 2 ký tự !");
        }

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