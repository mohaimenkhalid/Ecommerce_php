	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">

				<?php 

				$getiphone = $product->latestfromiphone();
				if ($getiphone) {
					while ($result = $getiphone->fetch_assoc()) {

				?>


				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productid'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>iphone</h2>
						<p><?php echo $fm->textshorten($result['body'],60);?></p>
						<div class="button"><span><a href="preview.php?proid=<?php echo $result['productid'];?>">Add to cart</a></span></div>
				   </div>
			   </div>

			<?php } } ?>

				<?php 

				$getdell = $product->latestfromdell();
				if ($getdell) {
					while ($result = $getdell->fetch_assoc()) {

				?>


				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productid'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>DELL</h2>
						<p><?php echo $fm->textshorten($result['body'],60);?></p>
						<div class="button"><span><a href="preview.php?proid=<?php echo $result['productid'];?>">Add to cart</a></span></div>
				   </div>
			   </div>

			<?php } } ?>
			</div>
			<div class="section group">
				<?php 

				$getsam = $product->latestfromsamsung();
				if ($getsam) {
					while ($result = $getsam->fetch_assoc()) {

				?>


				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productid'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Samsung</h2>
						<p><?php echo $fm->textshorten($result['body'],60);?></p>
						<div class="button"><span><a href="preview.php?proid=<?php echo $result['productid'];?>">Add to cart</a></span></div>
				   </div>
			   </div>

			<?php } } ?>


			<?php 

				$getlg = $product->latestfromlg();
				if ($getlg) {
					while ($result = $getlg->fetch_assoc()) {

				?>


				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php?proid=<?php echo $result['productid'];?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>LG</h2>
						<p><?php echo $fm->textshorten($result['body'],60);?></p>
						<div class="button"><span><a href="preview.php?proid=<?php echo $result['productid'];?>">Add to cart</a></span></div>
				   </div>
			   </div>

			<?php } } ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>

  	