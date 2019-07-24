
<?php include 'inc/header.php' ?>


<?php 
	if (isset($_GET['delpro'])) {
		 $delid = $_GET['delpro'];
		 $delproduct = $cart->delproductbycart($delid);
	}

?>

	<?php 

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$quantity = $_POST['quantity'];
				$cartid = $_POST['cartid'];
				$sid = session_id();
				$updatcart = $cart->updatcartquantity($quantity, $cartid);

				if ($quantity <=0 ) {
					 $updatcart = $cart->delproductbycart($cartid);
				}
			}

	?>

	



	<?php 
	//auto reload for cat session load..

	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
     	
 }
		?>
		
	





 <div class="main" >
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>

			    	<?php 

			    	if (isset($updatcart)) {
			    		echo $updatcart;
			    	}
			    	?>


			    	<?php 

			    	if (isset($delproduct)) {
			    		echo $delproduct;
			    	}
			    	?>
						


			    	<?php


			    	$login = Session::get("customerlogin");

			    	if ($login == true) {

?>
			    		<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

							<?php 

							$customerid = Session::get("customerid");
							$getcart = $cart->getcartbycustomerid($customerid);

							if ($getcart) {

								$sum=0;
								$quantity=0;
								while ($result = $getcart->fetch_assoc()) {

							?>

							<tr>
								<td><?php echo $result['productname'] ?></td>
								<td><img src="admin/<?php echo $result['image'] ?>" alt=""/></td>
								<td>

									$<?php echo $result['price']; ?>
										

									</td>
								<td>
									<form action="" method="post">




										<input type="hidden" name="cartid" value="<?php echo $result['cartid']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
									$<?php
									$total = $result['price'] * $result['quantity'];
									echo $total; 
										?>

								</td>
								<td><a onclick="return confirm('Are You Sure to Remove Product From Cart? ');" href="?delpro=<?php echo $result['cartid']; ?>"> X </a></td>

								
							</tr>

							<?php
							$sum = $sum + $total;
							$quantity  = $quantity + $result['quantity'];
							 ?>

							<?php  } } ?>


							
				
						</table>
			    		


			    <?php 	}else{

			    	?>				


			    	<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>


							<?php 

							
							$sid = session_id();
							$getcart = $cart->getcartbyid($sid);

							if ($getcart) {

								$sum=0;
								$quantity=0;
								while ($result = $getcart->fetch_assoc()) {

							?>

							<tr>
								<td><?php echo $result['productname'] ?></td>
								<td><img src="admin/<?php echo $result['image'] ?>" alt=""/></td>
								<td>

									$<?php echo $result['price']; ?>
										

									</td>
								<td>
									<form action="" method="post">




										<input type="hidden" name="cartid" value="<?php echo $result['cartid']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
									$<?php
									$total = $result['price'] * $result['quantity'];
									echo $total; 
										?>

								</td>
								<td><a onclick="return confirm('Are You Sure to Remove Product From Cart? ');" href="?delpro=<?php echo $result['cartid']; ?>"> X </a></td>

								
							</tr>

							<?php
							$sum = $sum + $total;
							$quantity  = $quantity + $result['quantity'];
							 ?>

							<?php  } } ?>


							
				
						</table>



			    <?php 	} ?>
   	



						<?php 		$sid = session_id();
									$getdata = $cart->checkcarttable($sid);

									if ($getdata) {
									?>

						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>TK. <?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php 

									$vat = $sum * 0.1;
									$grandtotal = $sum + $vat;
									echo "Tk. ".$grandtotal;

									Session::set("sum", $grandtotal);
									Session::set("quantity", $quantity);

									?>


								</td>
							</tr>
					   </table>


					<?php } else{ 

					//echo "CART is empty. Please continue shopping.."; 

					header("Location:index.php"); 

					} 
						?>

					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php' ?>