
<?php 

    include_once "./autoload.php";
    
    $edit_id = $_GET['edit_id'] ?? false;
    if( $edit_id ){
        $data = connect() -> query("SELECT * FROM users WHERE id='$edit_id'");
        $edit_user_data = $data -> fetch_object();

        if( $edit_user_data -> name == ""){
            header("location:user.php");
        }
    }else{
        header("location:user.php");
    }
   

?>

<!DOCTYPE html>
<html lang="en">

<head>


<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $edit_user_data -> name;?></title>
<!-- css files -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>

<div class="user-form w-25 my-5 mx-auto">
    <a class="btn btn-primary my-3" href="./user.php">Add New Members</a>
    <?php
        if(isset($_POST['submit'])){
            $name=$_POST['name'];
            $username=$_POST['username'];
            $email=$_POST['email'];
            $cell=$_POST['cell'];
            $gender=$_POST['gender'] ?? "";
            $education=$_POST['education'];

            
            $updated_at_data = date('Y-m-d h:i:s');

            if(empty($name) || empty($username) || empty($email) || empty($cell) || empty($gender) || empty($education)){
                $msg= validation("All Fields are required !", 'danger');
            }elseif (emailCheck($email)==false) {
                $msg= validation('Invalid Email Address', 'warning');
            }else{
                
                $updated_photo='';
                if(!empty($_FILES['new_photo']['name'])){
                    $updated_photo = photoUpload($_FILES['new_photo'],'photos/');
                }else{
                    $updated_photo = $edit_user_data -> photo;
                }

                connect() -> query("UPDATE users SET name='$name', username='$username', email='$email', cell='$cell', gender='$gender', education='$education', photo='$updated_photo', updated_at='$updated_at_data' WHERE id='$edit_id'");

                $data = connect() -> query("SELECT * FROM users WHERE id='$edit_id'");
                $edit_user_data = $data -> fetch_object();

                $msg= validation('Your data successfully updated', 'success');
             
            }

        }
    
        echo $msg ?? "";
    ?>
   
    <div class="card shadow">
        <div class="card-header text-center">
            <h2 style="color:red;" class="card-title"> Update <?php echo $edit_user_data -> name; ?> Data</h2>
        </div>
        <div class="card-body">

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name</label>
                    <input name="name" value="<?php echo $edit_user_data -> name; ?>" value="<?php echo old('name'); ?>" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">User Name</label>
                    <input name="username" value="<?php echo $edit_user_data -> username;?>" value="<?php echo old('username'); ?>" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input name="email" value="<?php echo $edit_user_data -> email; ?>" value="<?php echo old('email'); ?>" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Cell</label>
                    <input name="cell" value="<?php echo $edit_user_data -> cell;?>" value="<?php echo old('cell'); ?>" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Gender</label>
                    <input <?php echo $edit_user_data -> gender == 'Male' ? 'checked' : ""; ?> name="gender" type="radio" value="Male"><label for="">Male</label>
                    <input <?php echo $edit_user_data -> gender == 'Female' ? 'checked' : ""; ?> name="gender" type="radio" value="Female"><label for="">Female</label>
                </div>
                <div class="form-group">
                    <label for="">education</label>
                        <select name="education" id="" class="form-control">
                            <option value="">-Select-</option>
                            <option <?php echo $edit_user_data -> education == 'PSC' ? 'selected' : ""; ?> value="PSC">PSC</option>
                            <option <?php echo $edit_user_data -> education== 'JSC' ? 'selected' : ""; ?> value="JSC">JSC</option>
                            <option <?php echo $edit_user_data -> education == 'SSC' ? 'selected' : ""; ?> value="SSC">SSC</option>
                            <option <?php echo $edit_user_data -> education == 'HSC' ? 'selected' : ""; ?> value="HSC">HSC</option>
                        </select> 
                </div>
                <div class="form-group">
                    <img style="max-width:100%;" src="photos/<?php echo $edit_user_data -> photo; ?>" alt="">
                    <input name="new_photo" type="file"> 
                </div>
                <div class="form-group">
                    <input type="checkbox"> <label for=""> I Agree </label>
                </div>
                <div class="form-group">
                    <input name="submit" type="submit" class="btn btn-primary" value="Updated"> 
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