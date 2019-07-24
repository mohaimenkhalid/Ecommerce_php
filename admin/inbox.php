<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 

	include '../lib/Database.php';
	include '../helpers/Format.php';

	spl_autoload_register(function($class){
	include_once "../classes/".$class.".php"; 
	});

		$cart = new Cart();
		$fm = new Format();
?>


<?php 

	if (isset($_GET['processid'])) {

		$id = $_GET['processid'];
		$time = $_GET['date'];
		$price = $_GET['price'];

		$processconfirmed = $cart->processconfirmed($id, $time, $price);		
		
	}

?>

<?php 

	if (isset($_GET['shiftid'])) {

		$id = $_GET['shiftid'];
		$time = $_GET['date'];
		$price = $_GET['price'];

		$shift = $cart->shift($id, $time, $price);
		
		
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">  

                <?php 

			    	if (isset($processconfirmed)) {
			    		echo $processconfirmed;
			    	}
			    	?>  


			    	<?php 

			    	if (isset($shift)) {
			    		echo $shift;
			    	}
			    	?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Customer ID</th>
							<th>Order Date</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 

						
						$getorder = $cart->getallorderproduct();

						if ($getorder) {
							while ($result = $getorder->fetch_assoc()) {

						?>

						<tr class="odd gradeX">
							<td><?php echo $result['id'];?></td>
							<td><?php echo $result['customerid'];?></td>
							<td><?php echo $fm->formatDate($result['date']);?></td>
							<td><?php echo $result['productname'];?></td>
							<td><?php echo $result['quantity'];?></td>
							<td><?php echo $result['price'];?></td>
							<td><a href="">View Details</a> </td>
							
						<td>
							<?php 
								if ($result['status'] == '0' ) {
								?>

								<a href="?processid=<?php echo $result['customerid']; ?> &price=<?php echo $result['price']; ?> &date=<?php echo $result['date']; ?>" >Processing</a> 

							<?php } ?>

							<?php 
								if ($result['status'] == '1' ) {
								?>

								<a href="">Shifted</a> 

							<?php } ?>

							<?php 
								if ($result['status'] == '2' ) {
								?>

								<a href="?shiftid=<?php echo $result['customerid']; ?> &price=<?php echo $result['price']; ?> &date=<?php echo $result['date']; ?>" >Order Confirmed</a> 

							<?php } ?>


						</td>
						</tr>

					<?php } }  ?>
						
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
