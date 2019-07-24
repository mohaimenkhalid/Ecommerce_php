<?php include 'inc/header.php' ?>
<?php 
$login = Session::get("customerlogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>

<style>
	
.tblone{width: 550px; margin: 0 auto; margin-bottom: 150px; border:2px solid #ddd;}
.tblone tr td{text-align: justify;}	
.tblone input[type="text"]{width:400px; height: 30px; border:2px solid #ddd;}
.tblone input[type="submit"]{border:1px solid black; padding: 5px; }
</style>

<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$id = Session::get('customerid');
		$updateprodata = $cmr->updateprofiledata($_POST, $id);

	}

?>


 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="order">	

					<center> <h2 style="margin-bottom: 50px;"> Update Profile Details </h2> </center>

					<?php 

			    	if (isset($updateprodata)) {
			    		echo "<center>".$updateprodata."</center>";
			    	}

			    	?>




					<?php 

						$id = Session::get('customerid');
						$getcustomerdata = $cmr->getcustomerdata($id);

						if ($getcustomerdata) {
							while ($result = $getcustomerdata->fetch_assoc()) {
													
					?>


					<form action="" method="post">

					<table class="tblone">


							<tr>

								<td width="20%"> Name</td>
								<td>:</td>
								<td><input type="text" name="name" value="<?php echo $result['name']; ?>" /></td>

							</tr>
							<tr>
								<td>Phone</td>
								<td>:</td>
								<td><input type="text" name="phone" value="<?php echo $result['phone']; ?>" /></td>

							</tr>

							<tr>
								<td>Email</td>
								<td>:</td>
								<td><input type="text" name="email" value="<?php echo $result['email']; ?>" /></td>
							</tr>

							<tr>
								<td>Address</td>
								<td>:</td>
								<td><input type="text" name="address" value="<?php echo $result['address']; ?>" /></td>

							</tr>

							<tr>
								<td>Zip-Code</td>
								<td>:</td>
								<td><input type="text" name="zip" value="<?php echo $result['zip']; ?>" /></td>
							</tr>

							<tr>
								<td>City</td>
								<td>:</td>
								<td><input type="text" name="city" value="<?php echo $result['city']; ?>" /></td>
							</tr>

							<tr>
								<td>Country</td>
								<td>:</td>
								<td><input type="text" name="country" value="<?php echo $result['country']; ?>" /></td>

							</tr>

							<tr>
								<td></td>
								<td></td>
								<td>
									<input type="submit" name="submit" value="Update " />  <a style=' float: right; border:1px solid black; padding: 2px; margin-left: 0;' href="profile.php">Cancel</a>
								</td>

							</tr>
					</table>

					</form>

				<?php } } ?>

			
			</div>
				
 		</div>
 	</div>

<?php include 'inc/footer.php' ?>