<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
include_once($filepath.'/../lib/Session.php');

 ?>

<?php 

	/**
	 * Cart Class
	 */
class Cart{

			private $db;
		 	private $fm;
		 	
		 	public function __construct(){

		 		$this->db = new Database();
				$this->fm = new Format();
		 		
		 	}

		 	public function addtocart($quantity, $id){

		 		$quantity = $this->fm->validation($_POST['quantity']);
 				$quantity = mysqli_real_escape_string($this->db->link, $quantity);
 				$productid = mysqli_real_escape_string($this->db->link, $id);
 				$sid = session_id(); 

 				//get data from product table by product id...
 				
 				$squery = "SELECT * FROM tbl_product WHERE productid = '$productid' ";
 				$result = $this->db->select($squery)->fetch_assoc();

 				$productname = $result['productname'];
 				$price = $result['price'];
 				$image = $result['image'];

 				//check product exist or not
 				$chkquery = "SELECT * FROM tbl_cart WHERE  sid = '$sid' AND productid = '$productid' ";
 				$getpro = $this->db->select($chkquery);

 				if ($getpro) {
 					$msg = "Product already added into CART!";
 					return $msg;
 				}

 				else{

 					//insert to cart..


 					
 					$login = Session::get("customerlogin");

 					if ($login == true) {

 					$customerid = Session::get("customerid");

 						$query = "INSERT INTO tbl_cart(sid, productid, productname, price, quantity, image, customerid) VALUES('$sid', '$productid', '$productname', '$price',  '$quantity', '$image', '$customerid' )";


 						$inserted_rows =$this->db->insert($query);

                         if ($inserted_rows) {
                         
                        	header("Location:cart.php");

                        } else {

                        	header("Location:404.php");
                         
                        }


 						
 					}else{


 						$query = "INSERT INTO tbl_cart(sid, productid, productname, price, quantity, image) VALUES('$sid', '$productid', '$productname', '$price',  '$quantity', '$image' )";


 					$inserted_rows =$this->db->insert($query);

                         if ($inserted_rows) {
                         
                        	header("Location:cart.php");

                        } else {

                        	header("Location:404.php");
                         
                        }

 					}





 				
                    }
 				


		 	}


		 public function getcartbyid($sid){

		 		$query = " SELECT * FROM tbl_cart WHERE sid = '$sid' ";
		 		$result = $this->db->select($query);
		 		return $result;
 			}

 			public function getcartbycustomerid($customerid){

 				$query = "SELECT * FROM tbl_cart WHERE customerid = '$customerid' ";
		 		$result = $this->db->select($query);
		 		return $result;

 			}



 			public function updatcartquantity($quantity, $cartid){

 				$quantity = mysqli_real_escape_string($this->db->link, $quantity);
 				$cartid = mysqli_real_escape_string($this->db->link, $cartid);

		 		$query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartid = '$cartid' ";
		 		$result = $this->db->update($query);
		 		
		 		if ($result != false) {

		 			header("Location:cart.php");
				
				}else{

				$msg = "<span style='color:red; font-size:18px; '>Quantity not updated inserted !</span>";
				return $msg;
			}

 			}


 			public function delproductbycart($delid){

 				$delid = mysqli_real_escape_string($this->db->link, $delid);

 				$query = " DELETE FROM tbl_cart WHERE cartid = '$delid' ";
 				$result = $this->db->delete($query);

 				if ($result) {
 					$msg = "<span style='color:green; font-size:18px;' >Product removed from CART successfully!</span>";
					return $msg;
 				}else{

 					$msg = "<span style='color:red; font-size:18px;' >Product not Removed from CART successfully!</span>";
					return $msg;
 				}

 			}


 			public function checkcarttable($sid){

 				$query = "SELECT * FROM tbl_cart WHERE sid = '$sid' ";
		 		$result = $this->db->select($query);
		 		return $result;
 			}


 			public function delcustomercart($customerid){

 				
 				$query = "DELETE FROM tbl_cart WHERE customerid = '$customerid' ";
 				$this->db->delete($query);

 			}




 			public function orderproduct($customerid){

 				$sid = session_id();
 				$query = "SELECT * FROM tbl_cart WHERE sid = '$sid' AND customerid = '$customerid' ";
		 		$getdata = $this->db->select($query);

		 		if ($getdata) {

		 			while ($data = $getdata->fetch_assoc()) {

		 				$customerid = $data['customerid'];
		 				$productid = $data['productid'];
		 				$productname = $data['productname'];
		 				$quantity = $data['quantity'];
		 				$price = $data['price'] * $quantity;
		 				$image = $data['image'];


		 				$query = "INSERT INTO tbl_order(customerid, productid, productname, quantity, price, image) VALUES('$customerid', '$productid', '$productname', '$quantity',  '$price', '$image' )";

		 				$inserted_rows =$this->db->insert($query);


		 				

		 				
		 			}
		 		}
		 		
 			}


 			public function payableamount( $customerid ){


 				$query = "SELECT price FROM tbl_order WHERE customerid = '$customerid' AND date = now() ";
		 		$getdata = $this->db->select($query);

		 		return $getdata;
 			}


 			public function getorderproduct($customerid){


 				$query = "SELECT * FROM tbl_order WHERE customerid = '$customerid' AND status != '1'   ORDER BY id DESC";
		 		$getdata = $this->db->select($query);

		 		return $getdata;
 			}

 			public function getshiftedproduct($customerid){


 				$query = "SELECT * FROM tbl_order WHERE customerid = '$customerid' AND status ='1' ORDER BY id DESC";
		 		$getdata = $this->db->select($query);

		 		return $getdata;
 			}


 			public function delorderbyid($delorderid){

 				$delorderid = mysqli_real_escape_string($this->db->link, $delorderid);

 				$query = " DELETE FROM tbl_order WHERE id = '$delorderid' ";
 				$result = $this->db->delete($query);

 				if ($result) {
 					$msg = "<span style='color:green; font-size:18px;' >Order Cancel Successfully!</span>";
					return $msg;
 				}else{

 					$msg = "<span style='color:red; font-size:18px;' >Order not Cancel Successfully!</span>";
					return $msg;
 				}

 			}



 			public function getallorderproduct(){

 				$query = "SELECT * FROM tbl_order ORDER BY date DESC";
		 		$getdata = $this->db->select($query);
		 		return $getdata;

 			}


 			public function processconfirmed($id, $time, $price){

 				$id = mysqli_real_escape_string($this->db->link, $id);
 				$time = mysqli_real_escape_string($this->db->link, $time);
 				$price = mysqli_real_escape_string($this->db->link, $price);

 				$query = "UPDATE tbl_order SET status = '2' WHERE customerid = '$id' AND  date = '$time' AND price = '$price'  ";
 				$result = $this->db->update($query);

 				if ($result) {
 					$msg = "<span style='color:green; font-size:18px;' >Order Confirmed successfully!</span>";
					return $msg;
 				}else{

 					$msg = "<span style='color:green; font-size:18px;' >Order not Confirmed successfully!</span>";
					return $msg;
 				}
 			}


 			public function shift($id, $time, $price){

 				$id = mysqli_real_escape_string($this->db->link, $id);
 				$time = mysqli_real_escape_string($this->db->link, $time);
 				$price = mysqli_real_escape_string($this->db->link, $price);

 				$query = "UPDATE tbl_order SET status = '1' WHERE customerid = '$id' AND  date = '$time' AND price = '$price'  ";
 				$result = $this->db->update($query);

 				if ($result) {
 					$msg = "<span style='color:green; font-size:18px;' >Order shifted successfully!</span>";
					return $msg;
 				}else{

 					$msg = "<span style='color:green; font-size:18px;' >Order not shifted successfully!</span>";
					return $msg;
 				}
 			}




/*Extra(not related this project) shudent data show by date wise php file name ------ test.php------- db table -----test------ */

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

 /* shudent data show by date wise */



 	public function sname(){
 		
 		$query = "SELECT s.name FROM students AS s 
 						INNER JOIN friends AS f ON s.studentid = f.studentid
						INNER JOIN packages AS p1 ON s.studentid = p1.studentid
						INNER JOIN packages AS p2 ON f.friendid = p2.studentid
						WHERE p1.Salary < p2.Salary
						ORDER BY p2.Salary;

 		";

        $getdata = $this->db->select($query);
		return $getdata;
 		}







		
	}

?>