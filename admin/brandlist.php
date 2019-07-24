<?php include '../classes/Brand.php'; ?>

<?php 

      $brand = new Brand();  

      if (isset($_GET['delbrand'])) {
        	$id = $_GET['delbrand'];
        	$delbrand = $brand->delbrandbyid($id);
        }

?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand Item List</h2>
                <div class="block">

                <?php 
                if (isset($delbrand)) {
                	echo $delbrand;
                }

                ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th style="text-align: center;">Serial No.</th>
							<th style="text-align: center;">Brand Name</th>
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 

						$getbrand = $brand->getallbrand();

						if ($getbrand) {
							$i = 0;
							while ($result = $getbrand->fetch_assoc()) {
								$i++;
							
						?>
						
						<tr class="odd gradeX" style="text-align: center;">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandname'];  ?> </td>
							<td style="padding: 10px 0px 25px 0px">
								<a href="brandedit.php?brandid=<?php echo $result['brandid'];?>"><button class="btn success">Edit </button></a> <a onclick="return confirm('Are you sure to Delete Brand Item?')" href="?delbrand=<?php echo $result['brandid'];?>"><button class="btn danger">Delete</button></a>
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

