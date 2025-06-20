<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout main</title>
</head>
<style>
    iframe{
        background: whitesmoke;
        width: 100%;
        height: calc(100% - 180px);
        border: none;
        padding-bottom: 20px;
    }
</style>
<body>
    <iframe src="Controllers/BaseController.php?action=products_display" name="main" scrolling="yes"></iframe>
</body>
</html>