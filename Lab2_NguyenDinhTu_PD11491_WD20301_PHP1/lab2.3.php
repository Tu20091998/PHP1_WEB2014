<?php
    //Bài 3: Thiết kế lớp để quản lý sinh viên (SinhVien) 

    //tạo class chứa thông tin các đối tượng
    class SinhVien{
        //tạo các biến chứa thuộc tính của sinh viên
        private $hoTen;
        private $gioiTinh;
        private $ngaySinh;
        private $diemTB;

        //Tạo constructor nếu có truyền tham số, nếu k truyền tham số thì trả về giá trị mặc định
        public function __construct($hoTen = "", $gioiTinh = "", $ngaySinh = "", $diemTB = 0)
        {
            $this->hoTen = $hoTen;
            $this->gioiTinh = $gioiTinh;
            $this->ngaySinh = $ngaySinh;
            $this->diemTB = $diemTB;
        }

        //tạo getter và setter cho các thuộc tính
        //tạo hàm để lấy tên của sinh viên và hàm cập nhật tên sinh viên
        public function getHoTen(){
            return $this->hoTen;
        }
        public function setHoTen($hoTen){
            $this->hoTen = $hoTen;
        }

        //tạo hàm để lấy giới tính của sinh viên và hàm cập nhật giới tính sinh viên
        public function getGioiTinh(){
            return $this->gioiTinh;
        }
        public function setGioiTinh($gioiTinh){
            $this->gioiTinh = $gioiTinh;
        }

        //tạo hàm để lấy ngày sinh của sinh viên và hàm cập nhật ngày sinh của sinh viên
        public function getNgaySinh(){
            return $this->ngaySinh;
        }
        public function setNgaySinh($ngaySinh){
            $this->ngaySinh = $ngaySinh;
        }

        //tạo hàm để lấy điểm trung bình của sinh viên và hàm cập nhật điểm trung bình của sinh viên
        public function getDiemTB(){
            return $this->diemTB;
        }
        public function setDiemTB($diemTB){
            $this->diemTB = $diemTB;
        }

        //tạo hàm hiển thị các thông tin của sinh viên
        public function hienThiThongTin(){
            echo "Họ và tên: ". $this->getHoTen(). "<br>";
            echo "Giới tính: ". $this->getGioiTinh(). "<br>";
            echo "Ngày sinh: ". $this->getNgaySinh(). "<br>";
            echo "Điểm trung bình: ". $this->getDiemTB(). "<br>";
        }
    }
?>

<?php
    //tạo 1 mảng để lưu trữ các thông tin của sinh viên
    $mangSinhVien = [];

    //lấy dữ liệu của sinh viên từ form
    $hoTen = $_POST["hoTen"];
    $gioiTinh = $_POST["gioiTinh"];
    $ngaySinh = $_POST["ngaySinh"];
    $diemTB = $_POST["diemTB"];

    //khởi tạo đối tượng sinh viên và truyền thông tin vào đối tượng
    $sinhVien = new SinhVien($hoTen,$gioiTinh,$ngaySinh,$diemTB);

    //đưa thông tin sinh viên vào mảng
    $mangSinhVien[] = $sinhVien;

    //hiển thị thông tin sinh viên đã lưu (duyệt mảng)
    echo "<h2>Thông tin sinh viên đã lưu</h2>";
    foreach($mangSinhVien as $sv){
        $sv->hienThiThongTin();
        echo "<hr>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form nhập thông tin sinh viên</title>
</head>
<body>
    <h1>Nhập thông tin sinh viên</h1>
    <form method="post">
        <label for="hoTen">Họ và tên: </label>
        <input type="text" name="hoTen" required><br><br>

        <label for="gioiTinh">Giới tính: </label>
        <select name="gioiTinh" required>
            <option value="nam">Nam</option>
            <option value="nu">Nữ</option>
        </select><br><br>

        <label for="ngaySinh">Ngày sinh: </label>
        <input type="date" name="ngaySinh" required><br><br>

        <label for="diemTB">Điểm trung bình: </label>
        <input type="number" step="0.1" name="diemTB" required><br><br>

        <button type="submit">Gửi thông tin</button>
    </form>
</body>
</html>