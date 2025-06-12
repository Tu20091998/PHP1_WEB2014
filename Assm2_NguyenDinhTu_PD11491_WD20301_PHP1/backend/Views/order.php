
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng đã đặt</title>
</head>
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
        background: linear-gradient(to right, #4facfe, #00f2fe);
        margin: 0;
        padding: 20px;
    }

    table{
        width: 100%;
        border-collapse: collapse;
        background-color: #ccc;
    }

    th, td{
        border: 1px solid white;
        padding: 15px;
        text-align: center;
    }

    th {
        background-color:lightgray;
    }
</style>
<body>
    <h2>📦 Danh sách đơn hàng đã đặt</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Người dùng</th>
                <th>Ngày đặt</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order["order_id"]; ?></td>
                    <td><?php echo $order["user_id"]; ?></td>
                    <td><?php echo $order["order_date"]; ?></td>
                    <td><?php echo $order["name"]; ?></td>
                    <td><?php echo $order["quantity"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

