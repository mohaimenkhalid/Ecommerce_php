<?php include 'inc/header.php' ?>



 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	

					<h2>404 NOT FOUND</h2>
					
				
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