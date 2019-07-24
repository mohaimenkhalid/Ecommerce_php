<?php include 'inc/header.php' ?>
<?php 
$login = Session::get("customerlogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>
<?php 		$sid = session_id();
			$getdata = $cart->checkcarttable($sid);

		if ($getdata == false) {

			header("Location:index.php");
		}

?>


<style>
	
.tblone{width: 705px; float: right; margin-bottom: 25px; border:2px solid #ddd;}
.tblone th {text-align: justify;}	
.tblone tr td{text-align: justify;}	
.division{ width: 50%; float: left;  }
.division h2{ text-align: center;  margin-bottom: 20px;  }
.tbltwo{ border:2px solid #ddd; float:right;text-align:right; }
.tbltwo tr td{text-align: justify; padding: 5px 10px;}	
.order{text-align: center; margin-top: 40px;}
.order a{ background-color: red; color: white; font-size: 30px; padding: 5px 35px; border-radius: 5px; }
.order a:hover{ background-color: green; color: white;  }

</style>

<?php 

	if (isset($_GET['orderid']) && $_GET['orderid'] == 'order' ) {
		
		$customerid = Session::get("customerid");
		$insertorder = $cart->orderproduct($customerid);
		$deldata = $cart->delcustomercart($customerid);
		header('Location:success.php');
	}

?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    			<div class="division">


    				<table class="tblone">
    					<h2>Your Cart</h2>
							<tr>
								<th >Product Name</th>
								
								<th >Price</th>
								<th >Quantity</th>
								<th >Total Price</th>

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
								
								<td>

									$<?php echo $result['price']; ?>
										

									</td>
								<td>
													
									<?php echo $result['quantity']; ?>

								</td>
								<td>
									$<?php
									$total = $result['price'] * $result['quantity'];
									echo $total; 
										?>

								</td>
								

								
							</tr>

							<?php
							$sum = $sum + $total;
							$quantity  = $quantity + $result['quantity'];
							 ?>

							<?php  } } ?>


							
				
						</table>

							<table  width="40%" class="tbltwo">
							<tr>
								<td>Sub Total  </td>
								<td>:</td>
								<td>TK. <?php echo $sum; ?></td>
							</tr>
							<tr>
								<td>VAT  </td>
								<td>:</td>
								<td>10% <?php echo "( Tk. ". $sum*0.10." )"; ?> </td>
							</tr>
							<tr>
								<td>Grand Total </td>
								<td>:</td>
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

							<tr>
								<td>Quantity </td>
								<td>:</td>
								<td>
									<?php 
									
									echo $quantity;
									

									?>


								</td>
							</tr>

					   </table>


    			</div>
    			<div class="division">

    				<h2>Shipping Address</h2>
    				<?php 

					$id = Session::get('customerid');
					$getcustomerdata = $cmr->getcustomerdata($id);

					if ($getcustomerdata) {
						while ($result = $getcustomerdata->fetch_assoc()) {
							
						
					?>
					<table class="tblone">
							<tr>
								<td width="20%">Name</td>
								<td></td>
								<td><?php echo $result['name']; ?></td>

							</tr>

							<tr>
								<td>Phone</td>
								<td></td>
								<td><?php echo $result['phone']; ?></td>

							</tr>

							<tr>
								<td>Email</td>
								<td></td>
								<td><?php echo $result['email']; ?></td>
							</tr>

							<tr>
								<td>Address</td>
								<td></td>
								<td><?php echo $result['address']; ?></td>

							</tr>

							<tr>
								<td>Zip-Code</td>
								<td></td>
								<td><?php echo $result['zip']; ?></td>
							</tr>

							<tr>
								<td>City</td>
								<td></td>
								<td><?php echo $result['city']; ?></td>

							</tr>

							<tr>
								<td>Country</td>
								<td></td>
								<td><?php echo $result['country']; ?></td>

							</tr>

							<tr>
								
								<td></td>
								<td colspan="2" ><a style=' float: left; border:1px solid black; padding: 5px; margin-left: 0;' href="editprofile.php?proid=<?php echo $result['id']; ?>">Update Details </a> </td>
								
							</tr>

					</table>

				<?php } } ?>

    				
    			</div>

 		</div>

 			<div class="order"> <a href="?orderid=order">Order</a></div>
 	</div>

<?php include 'inc/footer.php' ?>

