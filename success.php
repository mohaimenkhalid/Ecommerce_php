<?php include 'inc/header.php' ?>
<?php 
$login = Session::get("customerlogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>

<style>
	
.success{ width: 50%; margin: 0 auto; min-height: 500px;  }
.success h2{ text-align: center;  margin-bottom: 20px;  border-bottom: 1px solid #ddd; font-size: 30px; }
.success{ text-align: center;  }
.success p { padding: 5px; font-size: 20px; text-align: left; }

</style>


 <div class="main">
    <div class="content">
    	<div class="section group">

    		

    		<div class="success">

    			<h2>Order Successfully Submitted !!</h2>

    			<?php 

		    		$customerid = Session::get('customerid');
		    		$amount = $cart->payableamount($customerid);

		    		if ($amount) {
		    			$sum = 0;
		    			while ($result = $amount->fetch_assoc()) {

		    				$price = $result['price'];
		    				$sum = $sum + $price;
    			

    		?>

    		<?php 	 } } ?>

    			<p>Total Payable Amount (Inc. VAT) : 

    			<?php 

    			$vat = $sum*0.1;
    			$total = $sum + $vat;
    			echo $total;

    			 ?> </p>

    			
    			<p>Thanks for Parchange. Receive Your Order Successfully. We will contact with you as soon as possible. </p>
    			<p> See Ordered details >> <a href="orderdetails.php">CLICK HERE</a></p>
    			


    		</div>



    				
    	</div>

 		</div>

 			
 	</div>

<?php include 'inc/footer.php' ?>

