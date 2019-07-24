<?php include 'inc/header.php' ?>
<?php 
$login = Session::get("customerlogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="order">	


					<h2>Your Orderd Details</h2>



			    	<table class="tblone">
						<tr>
								<th >Name</th>

								<?php 

							$test = $cart->test();

							if ($test) {
						
							while ($result = $test->fetch_assoc()) {
									
							?>

								<th ><?php echo $result['month'] ?></th>

							<?php } } ?>
								
						</tr>



					<?php 


							$test = $cart->name();
							if ($test) {
							while ($result = $test->fetch_assoc()) {

							?>
							<tr>
								<td><?php echo $name = $result['name'] ?></td>


									<?php 
										$test1 = $cart->salary($name);
										if ($test1) {
										while ($result1 = $test1->fetch_assoc()) {
											?>
											<td><?php echo $result1['salary']  ?></td>

									<?php }}?>

							</tr>



					<?php } }  ?>

						</table>
				
	</div>


<h2>Your Orderd Details</h2>
			    	<table class="tblone">
						<tr>
								<th >Name</th>

								
						</tr>

						<?php 

						$name = $cart->sname();
						if ($name) {
							while ($result = $name->fetch_assoc()) {
							
						?>
						<tr>
							
							<td><?php echo $result['name'] ?></td>
							
						</tr>

					<?php } } ?>

							

						</table>
				
	</div>
				
 		</div>
 	</div>

<?php include 'inc/footer.php' ?>


<?php 
/*Extra(not related this project) shudent data show by date wise php file name ------ test.php------- db table -----test------ 

 			public function test(){

 				$query = "SELECT DISTINCT month FROM test ORDER BY id ASC ";
		 		$getdata = $this->db->select($query);
		 		return $getdata;
 			}


 			public function name(){

 				$query = "SELECT DISTINCT name FROM test ";
		 		$getdata = $this->db->select($query);
		 		return $getdata;
 			}

 			public function salary($name){

 				$query = "SELECT salary  from test 
 				WHERE name = '$name' 
 				ORDER BY salary DESC";
 				//ORDER BY id ASC

		 		$getdata = $this->db->select($query);
		 		return $getdata;
 			}

 /* shudent data show by date wise 


 */ ?>	
