    
    document.querySelector(".login-form").addEventListener("submit", function(e){

        //lấy các giá trị từ form và div hiển thị lỗi
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        const errorDiv = document.getElementById("login-error");

        //cho mảng chứa lỗi là rỗng
        let error = [];

        //kiểm tra lỗi rỗng
        if(!username) error.push("Vui lòng nhập tên đăng nhập !");
        if(!password) error.push("Vui lòng nhập mật khẩu !");

        //kiểm tra độ dài mật khẩu tối thiểu
        if(password && password.length < 2){
            error.push("Mật khẩu phải có ít nhất 6 ký tự !");
        }

        //kiểm tra có lỗi hay không
        if(error.length > 0 ){
            //chặn gửi form nếu có lỗi
            e.preventDefault();

            //đưa lỗi lấy được vào form rồi hiển thị
            errorDiv.innerHTML = error.join("<br>");
        }
        else{
            //form được gửi đi và xoá hết lỗi
            errorDiv.innerHTML = "";
        }
    });