<?php
include './phpHandler/connection.php';
$query = "SELECT image from products where id=1";
$action = mysqli_query($connect,$query);
$result = mysqli_fetch_object($action);
$num = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($result->image); ?>" />
    <?= ($num-1)%3?>
</body>
</html>