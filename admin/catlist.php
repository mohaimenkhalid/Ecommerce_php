<?php include '../classes/Category.php'; ?>

<?php 

      $cat = new Category();  

      if (isset($_GET['delcat'])) {
        	$id = $_GET['delcat'];
        	
        	$delcat = $cat->delcatbyid($id);
        }  


?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">

                <?php 
                if (isset($delcat)) {
                	echo $delcat;
                }

                ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th style="text-align: center;">Serial No.</th>
							<th style="text-align: center;">Category Name</th>
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 

						$getcat = $cat->getallcat();

						if ($getcat) {
							$i = 0;
							while ($result = $getcat->fetch_assoc()) {
								$i++;
							
						?>
						
						<tr class="odd gradeX" style="text-align: center;">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catname'];  ?> </td>
							<td style="padding: 10px 0px 10px 0px">
					<a href="catedit.php?catid=<?php echo $result['catid'];?>"><button class="btn success">Edit</button></a>
					<a onclick="return confirm('Are you sure to Delete category?')" href="?delcat=<?php echo $result['catid'];?>"><button class="btn danger">Delete</button></a>
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

