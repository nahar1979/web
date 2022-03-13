
<?php 

include_once "./autoload.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Development Area</title>
<!-- ALL CSS FILES  -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
<?php

    $user_id = $_GET['user_id'] ?? false;
    if( $user_id ){
       $data = connect() -> query("SELECT * FROM users WHERE id='$user_id'");
       $user_data = $data -> fetch_object();
       if($user_data -> name == ""){
        header('location:table.php');
       }
        
    }else{
        header('location:table.php');
    }

?>


<div style="width:500px; margin: 0 auto;" class="single-user my-5">
    <div class="card shadow">
        <img style="max-width:100%;" src="photos/<?php echo $user_data -> photo; ?>" alt="">
    </div>
    <div class="card-body">
        <h2> <?php echo $user_data -> name; ?></h2>
        <h2> <?php echo $user_data -> cell; ?> </h2>
        <h2> <?php echo $user_data -> email; ?> </h2>
    </div>
    <a style="margin:0 auto;" class="btn btn-primary" href="./table.php">Go to Back</a>
</div>


                    








<!-- JS FILES  -->
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/custom.js"></script>





</body>
</html>