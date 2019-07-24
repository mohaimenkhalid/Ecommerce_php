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

</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="order">	

					<center> <h2 style="margin-bottom: 50px;">Profile Details</h2></center>

					<?php 

					$id = Session::get('customerid');
					$getcustomerdata = $cmr->getcustomerdata($id);

					if ($getcustomerdata) {
						while ($result = $getcustomerdata->fetch_assoc()) {
							
						
					?>
					<table class="tblone">
							<tr>
								<td width="20%">Name</td>
								<td>:</td>
								<td><?php echo $result['name']; ?></td>

							</tr>

							<tr>
								<td>Phone</td>
								<td>:</td>
								<td><?php echo $result['phone']; ?></td>

							</tr>

							<tr>
								<td>Email</td>
								<td>:</td>
								<td><?php echo $result['email']; ?></td>
							</tr>

							<tr>
								<td>Address</td>
								<td>:</td>
								<td><?php echo $result['address']; ?></td>

							</tr>

							<tr>
								<td>Zip-Code</td>
								<td>:</td>
								<td><?php echo $result['zip']; ?></td>
							</tr>

							<tr>
								<td>City</td>
								<td>:</td>
								<td><?php echo $result['city']; ?></td>

							</tr>

							<tr>
								<td>Country</td>
								<td>:</td>
								<td><?php echo $result['country']; ?></td>

							</tr>

							<tr>
								
								<td></td>
								<td colspan="2" ><a style=' float: left; border:1px solid black; padding: 5px; margin-left: 0;' href="editprofile.php?proid=<?php echo $result['id']; ?>">Update Details </a> <a style=' float: right; border:1px solid black; padding: 5px; margin-left: 0;' href="updatepass.php">Update Password </a></td>
								

							</tr>


					</table>

				<?php } } ?>

			
			</div>
				
 		</div>
 	</div>

<?php include 'inc/footer.php' ?>