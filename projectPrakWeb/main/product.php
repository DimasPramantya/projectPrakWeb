<?php
session_start();
include '../phpHandler/connection.php';
if(empty($_SESSION['email'])){
    header('location: ../login.php?status=not_yet_login');
}
$productId = $_GET['productId'];
$query = "SELECT * FROM products WHERE id = '$productId'";
$action = mysqli_query($connect,$query);
$product = mysqli_fetch_object($action);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="d-block ps-5 sticky-top bg-606c38">
        <ul class="nav justify-content-center p-3">
            <li class="nav-item me-4 py-6px px-2 d-flex justify-content-center rounded-3">
                <a href="../index.php" class="text-decoration-none text-white">Home</a>
            </li>
            <li class="nav-item me-4 px-2 d-flex justify-content-center rounded-3">
                <div class="dropdown">
                    <button class="btn border-0 dropdown-toggle text-white" type="button" data-bs-toggle="dropdown">Products</button>
                    <ul class="dropdown-menu py-0">
                        <li><a href="productCategory.php?category=face" class="dropdown-item">Face</a></li>
                        <li><a href="productCategory.php?category=hair" class="dropdown-item">Hair</a></li>
                        <li><a href="productCategory.php?category=body" class="dropdown-item">Body</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item my-6px px-2 d-flex justify-content-center rounded-3">
                <a href="./cart.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-bag" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                    </svg>
                </a>
            </li>
            <li class="nav-item ms-4 py-6px px-2 d-flex justify-content-center rounded-3">
                <a href="about.php" class="text-decoration-none ps-6px text-white">About</a>
            </li>
        </ul>
    </div>
    <div class="container mt-container-navbar">
        <div class="row">
            <div class="col-6 ps-5">
                <span class="logo">nature skin</span>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6 offset-4 d-flex justify-content-end mb-4">
                        <div class="input-group h-25">
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text bg-white border-1">x</span>
                        </div>
                    </div>
                    <div class="col-2 pe-5 mb-4">
                        <span class="profile">
                            <a href="editAcc.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 row">
            <div class="col-5">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($product->image); ?>"  alt="<?= $product->name ?>" class="img-single-product ps-5" />
            </div>
            <div class="col-6">
                <div class="row-cols-1">
                    <div class="col col-9 lh-1">
                        <span class="font-oranienbaum font-size-27">
                            <?= strtoupper($product->name)." ".$product->size ?>
                        </span>
                    </div>
                    <div class="col col-4 lh-1">
                        <span class="font-oranienbaum font-size-27">
                            Rp <?= $product->price ?>
                        </span>
                    </div>
                    <div class="col my-3">
                        <div class="row">
                            <div class="col-2">
                                <form action="../phpHandler/cart.php?productId=<?=$productId?>" method="post" id="cart">
                                    <input type="number" name="productAmmount" class="form-control form-control-sm bg-brown" value="0">
                                </form>
                            </div>
                            <div class="col-2">
                                <input type="submit" form="cart" value="Add To Cart" class="text-white border-0 bg-606c38 font-robotocondensed font-size-13 py-2 px-3 lh-1">
                            </div>
                        </div>
                    </div>
                    <div class="col col-3 mb-2">
                        <span class="font-ttnorms fw-bold color-524d4b font-size-16">Stock: <?=$product->stock?> Products</span>
                    </div>
                    <div class="col col-12 mb-2">
                        <span class="font-oranienbaum font-size-22"><?=$product->adsTitle?></span>
                    </div>
                    <div class="col col-8">
                        <span class="font-ttnorms color-524d4b font-size-16">
                            <?= $product->description ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>