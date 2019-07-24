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

				header('Location:index.php');
			}
	?>



<style>
	
	.payment{ width: 500px; min-height: 200px; text-align: center; border:1px solid #ddd; margin: 0 auto; padding: 50px;  }
	.payment h2{border-bottom: 1px solid #ddd; margin-bottom: 40px; padding-bottom: 10px; }
	.payment a{ background-color: red; color: white; font-size: 25px; padding: 5px 30px; border-radius: 5px; }
	.payment a:hover{ background-color: green; color: white; padding: 10px 35px; border-radius: 5px; }
	.back{width: 500px; min-height: 200px; text-align: center;  margin: 20px auto; display: block;}
	.back a{ background-color: #555; color: white; font-size: 25px; padding: 5px 30px; border-radius: 5px;}
	.back a:hover{ background-color: green; color: white;  }

</style>


 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="payment">
    			<h2>Choose Payment Option</h2>
    			<a href="paymentoffline.php">Offline Payment</a>
    			<a href="paymentonline.php" >Online Payment</a>

    		</div>

    		<div class="back">
    			
    			<a href="cart.php">Previous</a>
    		</div>
	
 		</div>
 	</div>

<?php include 'inc/footer.php' ?>

