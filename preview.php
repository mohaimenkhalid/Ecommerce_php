<?php include 'inc/header.php' ?>

<?php 

if (isset($_GET['proid'])) {
   
    $id = $_GET['proid'];
}


	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		
		$quantity = $_POST['quantity'];
		$addcart = $cart->addtocart($quantity, $id);
	}

?>


<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['compare']))  {
		
		$customerid = Session::get('customerid');
		$productid = $_POST['productid'];
		$insertcompare = $product->insertcomparedata($customerid, $productid);

	}

?>



 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	
					<?php

				
                                $getproduct = $product->getproductbyid($id);
                                if ($getproduct) {
                                while ($result = $getproduct->fetch_assoc()) {

                                ?>


					<div class="grid images_3_of_2">
						<img  src="admin/<?php echo $result['image'];  ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productname'];  ?></h2>
										
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'];  ?></span></p>
						<p>Category: <span><?php echo $result['catname'];  ?></span></p>
						<p>Brand:<span><?php echo $result['brandname'];  ?></span></p>
					</div>

					
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>




			<?php 
							$login = Session::get("customerlogin");
							if ($login == true) {
		
					?>

				<div class="add-cart">
					<form action="" method="post">
						<input type="hidden" class="buyfield" name="productid" value="<?php echo $result['productid'];  ?>"/>
						<input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>

						<input type="submit" class="buysubmit" name="wishist" value="Add to Wishlist"/>
					</form>				
				</div>


			<?php } ?>




				<br>



				<?php 

			    	if (isset($insertcompare)) {
			    		echo $insertcompare;
			    	}
			    	?>
 
				<span style="color: red; font-size: 18px;">
					
					<?php 

			    	if (isset($addcart)) {
			    		echo $addcart;
			    	}
			    	?>
				</span>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $result['body'];  ?>
	    </div>

	<?php } } ?>
				
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>

					<ul>
						<?php 

						$getcat = $cat->getallcat();

						if ($getcat) {
							$i = 0;
							while ($result = $getcat->fetch_assoc()) {
								$i++;
							
						?>
				      <li><a href="productbycat.php?catid=<?php  echo $result['catid']; ?>"><?php echo $result['catname'];?></a></li>

				      <?php } } ?>
				      
    				</ul>

						
    	
 				</div>
 		</div>
 	</div>

<?php include 'inc/footer.php' ?>