<?php include 'inc/header.php' ?>
<?php 
$login = Session::get("customerlogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>

<style>
	
.tblone{width: 550px; margin: 0 auto; border:2px solid #ddd; margin-bottom: 200px;  margin-top: 15px;}
.tblone tr td{text-align: justify;}	
.tblone input[type="text"]{width:300px; height: 25px; border:2px solid #ddd;}
.tblone input[type="submit"]{border:1px solid black; }
</style>

<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {


		
		
		$id = Session::get('customerid');
		$updatepassword = $cmr->updatepassword($_POST, $id);

	}
	

?>


 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="order">	

					<center> <h2 style="margin-bottom: 50px;"> Update Password </h2> </center>

					<?php 

			    	if (isset($updatepassword)) {
			    		echo "<center>".$updatepassword."</center>";
			    	}

			    	?>	

			<form action="" method="post">

					<table class="tblone">

							<tr>
								<td width="30%"> Old Password</td>
								<td></td>
								<td><input type="text" name="oldpass"  /></td>

							</tr>
							<tr>
								<td>New Password</td>
								<td></td>
								<td><input type="text" name="newpass"  /></td>

							</tr>

							

							<tr>
								<td></td>
								<td></td>
								<td>
									<input type="submit" name="submit" value="Update password" /> <a style=' float: right; border:1px solid black; padding: 2px; margin-left: 0;' href="profile.php">Cancel</a>
								</td>

							</tr>
					</table>

					</form>


			
			</div>
				
 		</div>
 	</div>

<?php include 'inc/footer.php' ?>