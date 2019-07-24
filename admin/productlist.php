<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../helpers/Format.php'; ?>
<?php include '../classes/Product.php'; ?>

<?php 

	$product = new Product();
	$fm = new Format(); 

?>

<?php 

	if (isset($_GET['delproduct'])) {
		$id = $_GET['delproduct'];
        $delproduct = $product->delproductbyid($id);
	}

?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
        	<?php 

        		if (isset($delproduct)) {
        			echo $delproduct;
        		}
        	?>

            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

				<?php 
						$getproduct = $product->getallproduct();

						if ($getproduct) {
							$i = 0;
							while ($result = $getproduct->fetch_assoc()) {
								$i++;
							
						?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['productname'];?></td>
					<td><?php echo $result['catname'];?></td>
					<td><?php echo $result['brandname'];?></td>
					<td><?php echo $fm->textShorten($result['body'], 50);?></td>
					<td><?php echo $result['price'];?></td>
					<td><img src="<?php echo $result['image']; ?>" height="70px" width="90px" ></td>
					<td>

						<?php 

						if ($result['type'] == '0') {
							echo "Featured";
						}else{

							echo "General";
						}

						?>
							
						</td>
							<td style="padding: 10px 0px 25px 0px">
								<a href="procuctedit.php?productid=<?php echo $result['productid'];?>"><button class="btn success">Edit</button></a>  <a  onclick="return confirm('Are you sure to Delete Product ?')" href="?delproduct=<?php echo $result['productid'];?>"><button class="btn danger">Delete</button></a>
							</td>
				</tr>

			<?php } } ?>
				
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
