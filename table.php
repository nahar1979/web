
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
	
	

	<div class="wrap-table shadow">
	<?php
	
		$delete_id = $_GET['delete_id'] ?? false;
		if( $delete_id ){
			connect() -> query("DELETE FROM users WHERE id='$delete_id'");
			header("location:table.php");
		}
	
	?>

		<a class="btn btn-primary my-3" href="./user.php">All Data</a>
		<div class="card">
			<div class="card-body">
				<h2>All Data</h2>

				<form action="" class="form-inline" method="POST">
					<div class="form-group">
						<select name="gender" id="" class="form-control">
							<option value="">-Select-</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					<div class="form-group">
						<select name="education" id="" class="form-control">
							<option value="">-Education-</option>
							<option value="JSC">JSC</option>
							<option value="PSC">PSC</option>
							<option value="SSC">SSC</option>
							<option value="HSC">HSC</option>
						</select>
					</div>
					<div class="form-group">
						<input name="search" type="submit" value="search" class="btn btn-primary">
					</div>
				</form>


				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Photo</th>
							<th style=width:200px;>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 

							$data = connect() -> query("SELECT * FROM users");

							if(isset($_POST['search'])){
								$gender = $_POST['gender'];
								$education = $_POST['education'];

								$data = connect() -> query("SELECT * FROM users WHERE gender='$gender' AND education='$education'");
							}else{

							}

							$sn=1;
							while( $user = $data -> fetch_object()) :

						
						?>

						<tr>
							<td><?php echo $sn; $sn++; ?></td>
							<td><?php echo $user -> name; ?></td>
							<td><?php echo $user -> email; ?></td>
							<td><?php echo $user-> cell; ?></td>
							<td><img src="photos/<?php echo $user-> photo; ?>" alt=""></td>
							<td>
								<a class="btn btn-sm btn-info" href="./single.php?user_id=<?php echo $user -> id; ?>">View</a>
								<a class="btn btn-sm btn-warning" href="./edit.php?edit_id=<?php echo $user -> id; ?>">Edit</a>
								<a class="btn btn-sm btn-danger delete_btn" href="?delete_id=<?php echo $user-> id; ?>">Delete</a>
							</td>
						</tr>
						
						<?php endwhile; ?>
					
						

					</tbody>
				</table>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>

	<script>

	$('.delete_btn').click(function(){

		let conf = confirm(" Are you sure delete your data ? ");
		if(conf){

		}else{
			return false;
		}

	});

	</script>



</body>
</html>