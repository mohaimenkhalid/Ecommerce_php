<?php include 'inc/header.php' ?>
<?php 
$login = Session::get("customerlogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>

<?php 
	if (isset($_GET['delorder'])) {
		 $delorderid = $_GET['delorder'];
		 $delorder = $cart->delorderbyid($delorderid);
	}

?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="order">	
					<?php 

			    	if (isset($delorder)) {
			    		echo $delorder;
			    	}
			    	?>



					<h2>Your Orderd Details</h2>



			    	<table class="tblone">
							<tr>
								<th >No</th>
								<th >Product Name</th>
								<th >Image</th>
								<th >Quantity</th>
								<th >Price</th>
								<th >Date</th>
								<th >Status</th>
								<th >Action</th>
							</tr>

							
							<?php 					

							$customerid = Session::get('customerid');
							$getorder = $cart->getorderproduct($customerid);

							if ($getorder) {

								$i = 0;

								$quantity=0;
								while ($result = $getorder->fetch_assoc()) {
										$i++;
							?>

							<tr>
								<td><?php echo $i ; ?></td>
								<td><?php echo $result['productname'] ?></td>
								<td><img src="admin/<?php echo $result['image'] ?>" alt=""/></td>
								<td>

									<?php echo $result['quantity']; ?>
										
								
								<td>
									$<?php
									$total = $result['price'] * $result['quantity'];
									echo $total; 
									 ?>

								</td>
								<td><?php echo $fm->formatDate($result['date']); ?></td>

							<td>

								<?php 
								if ($result['status'] == '0' ) {
									echo "Processing";
								}
								if ($result['status'] == '1' ) {
									echo "Shifted";
								}
								if ($result['status'] == '2' ) {
									echo "Order Confirmed";
								}

								?>

							</td>



								<?php 

								if ($result['status'] == '0' ) {

								?>

								<td><a onclick="return confirm('Are You Sure to Cancel Order ? ');" href="?delorder=<?php echo $result['id']; ?>"> X </a></td>

								<?php } else{ 

								 ?>

								 <td>N/A</td>

									<?php } ?>
							</tr>

						<?php } }  ?>

						</table>
				
	</div>
	<br>

					<div class="order">	
					

					<h2>Shifted Order</h2>



			    	<table class="tblone">
							<tr>
								<th >No</th>
								<th >Product Name</th>
								<th >Image</th>
								<th >Quantity</th>
								<th >Price</th>
								<th >Date</th>
								<th >Status</th>
								<th >Action</th>
							</tr>

							
							<?php 					

							$customerid = Session::get('customerid');
							$getorder = $cart->getshiftedproduct($customerid);

							if ($getorder) {

								$i = 0;

								$quantity=0;
								while ($result = $getorder->fetch_assoc()) {
										$i++;
							?>

							<tr>
								<td><?php echo $i ; ?></td>
								<td><?php echo $result['productname'] ?></td>
								<td><img src="admin/<?php echo $result['image'] ?>" alt=""/></td>
								<td>

									<?php echo $result['quantity']; ?>
										
								
								<td>
									$<?php
									$total = $result['price'] * $result['quantity'];
									echo $total; 
									 ?>

								</td>
								<td><?php echo $fm->formatDate($result['date']); ?></td>

								<td>

								<?php 


								
								if ($result['status'] == '1' ) {
									echo "Shifted";
								}

								?>
									
								</td>

								 <td>N/A</td>

									
							</tr>

						<?php } }  ?>

						</table>
				
	</div>
				
 		</div>
 	</div>

<?php include 'inc/footer.php' ?>