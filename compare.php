
<?php include 'inc/header.php' ?>



<style>

table.tblone img{height:150px; width: 100px;}	
	


</style>

 <div class="main" >
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare Product</h2>

			   


			    	<?php


			    	$login = Session::get("customerlogin");

			    	if ($login == true) {

?>
			    		<table class="tblone">
							<tr>
								<th >Serial Name</th>
								<th >Product Name</th>
								<th>Price</th>
								<th >Image</th>
								<th >Action</th>
							</tr>

							<?php 

							$customerid = Session::get("customerid");

							$getcompare = $product->getcomparedata($customerid);

							if ($getcompare) {

								$i = 0;
								while ($result = $getcompare->fetch_assoc()) {

									$i++;

							?>

							<tr>

								
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productname']; ?></td>
								<td> $<?php echo $result['price']; ?> </td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td><a href="preview.php?proid=<?php echo $result['productid'];?>" class="details">View</a></td>
								
								
							</tr>

						<?php } } ?>

						</table>

					<?php } else{ header("Location:index.php"); }  ?>


					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%; text-align: center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>


<?php include 'inc/footer.php' ?>