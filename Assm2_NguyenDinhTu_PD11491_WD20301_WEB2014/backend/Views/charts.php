<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Biểu đồ sản phẩm theo danh mục</title>
    <style>
        .chart_product_category{
            padding: 3rem;
            border: 1px solid lightgray;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Danh mục', 'Số sản phẩm'],
                <?php foreach ($data as $row): ?>
                    ['<?= $row['category_name'] ?>', <?= $row['total'] ?>],
                <?php endforeach; ?>
            ]);

            var options = {
                title: '🎯 Thống kê sản phẩm theo danh mục',
                is3D: true,
                pieSliceText: 'percentage'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div class="chart_product_category">
        <h1 style="text-align: center;">Biểu đồ thống kê danh mục</h1>
        <div id="piechart_3d" style="width: 100%; height: 30vh;"></div>
    </div>
</body>
</html>