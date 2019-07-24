<?php include 'inc/header.php' ?>


<?php 
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location = '404.php'; </script>";
}else{

    $id = $_GET['catid'];
}

?>


 <div class="main">
    <div class="content">


    	<div class="section group">
				<div class="cont-desc span_1_of_2">	

					
	<div class="content_top">
    		<div class="heading">
<?php 

	      $getcat = $cat->getcatbyid($id);

	      if ($getcat) {
	      	$result = $getcat->fetch_assoc() 
	      
	      ?>
    		<h3><?php echo $result['catname']  ?></h3>


    	<?php }  ?>

    		</div>

    		<div class="clear"></div>
    	</div>


    	   <div class="section group">

	      <?php 

	      $getproduct = $product->getproductbycat($id);

	      if ($getproduct) {
	      	while ($result = $getproduct->fetch_assoc()) {
	      
	      ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?proid=<?php echo $result['productid']  ?>"><img  height="170" src="admin/<?php  echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productname']  ?></h2>
					  <?php echo $fm->textshorten($result['body'],60);?>
					 <p><span class="price">$<?php echo $result['price'];  ?></span></p>
				     <div class="button"><span><a href="preview.php?proid=<?php echo $result['productid'];?>" class="details">Details</a></span></div>
				</div>

			<?php } } else{

				echo "<br><h2 style='margin-top:60px;'><center>404 NOT FOUND</center></h2><br>";
				echo "<br><center><span style='color:orange; font-size:20px;' >There is No Product available from this Categorey.<span></center><br>";


			} ?>
				
				
				
			</div>




					
				
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