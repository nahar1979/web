
<?php 

    include_once "./autoload.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>

    <div class="user-form w-25 my-5 mx-auto">
        <a class="btn btn-primary my-3" href="./table.php">Add New Members</a>
        <?php
            if(isset($_POST['submit'])){
                $name=$_POST['name'];
                $username=$_POST['username'];
                $email=$_POST['email'];
                $cell=$_POST['cell'];
                $gender=$_POST['gender'] ?? "";
                $education=$_POST['education'];

                if(empty($name) || empty($username) || empty($email) || empty($cell) || empty($gender) || empty($education)){
                    $msg= validation("All Fields are required !", 'danger');
                }elseif (emailCheck($email)==false) {
                    $msg= validation('Invalid Email Address', 'warning');
                }else{

                   $file_name = photoUpload($_FILES['photo'], 'photos/');

                    connect() -> query("INSERT INTO users (name, username, email, cell, gender, education, photo)VALUES('$name','$username','$email','$cell','$gender','$education', '$file_name')");

                    $msg = validation('Data Stable', 'success');
                    formClear();
                }

            }
        
        



            echo $msg ?? "";
        ?>
       

        <div class="card shadow">
            <div class="card-header text-center">
                <h2 style="color:red;" class="card-title">Creat An Account</h2>
            </div>
            <div class="card-body">

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input name="name" value="<?php echo old('name'); ?>" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">User Name</label>
                        <input name="username" value="<?php echo old('username'); ?>" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input name="email" value="<?php echo old('email'); ?>" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Cell</label>
                        <input name="cell" value="<?php echo old('cell'); ?>" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <input <?php echo old('gender')== 'Male' ? 'checked' : ""; ?> name="gender" type="radio" value="Male"><label for="">Male</label>
                        <input <?php echo old('gender')== 'Female' ? 'checked' : ""; ?> name="gender" type="radio" value="Female"><label for="">Female</label>
                    </div>
                    <div class="form-group">
                        <label for="">education</label>
                            <select name="education" id="" class="form-control">
                                <option value="">-Select-</option>
                                <option <?php echo old('education')== 'PSC' ? 'selected' : ""; ?> value="PSC">PSC</option>
                                <option <?php echo old('education') == 'JSC' ? 'selected' : ""; ?> value="JSC">JSC</option>
                                <option <?php echo old('education')== 'SSC' ? 'selected' : ""; ?> value="SSC">SSC</option>
                                <option <?php echo old('education')== 'HSC' ? 'selected' : ""; ?> value="HSC">HSC</option>
                            </select> 
                    </div>
                    <div class="form-group">
                        <input name="photo" type="file"> 
                    </div>
                    <div class="form-group">
                        <input type="checkbox"> <label for=""> I Agree </label>
                    </div>
                    <div class="form-group">
                        <input name="submit" type="submit" class="btn btn-primary" value="Submit"> 
                    </div>
                </form>

            </div>
        </div>
    </div>









    <!-- js files -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>

</html>