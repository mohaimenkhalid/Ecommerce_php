<?php 

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

 ?>


<?php 

 /**
  * Admin Login class
  */
 class Adminlogin {

 	private $db;
 	private $fm;
 	
 	public function __construct(){

 		$this->db = new Database();
		$this->fm = new Format();
 		
 	}

 	public function adminlogin($adminuser, $adminpass){


 		$adminuser = $this->fm->validation($_POST['adminuser']);
 		$adminpass = $this->fm->validation(md5($_POST['adminpass']));

 		$adminuser = mysqli_real_escape_string($this->db->link, $adminuser);
		$adminpass = mysqli_real_escape_string($this->db->link, $adminpass);

		if (empty($adminuser) || empty($adminpass)) {
			$loginmsg = "Username or Password must not be empty! ";
			return $loginmsg;
		}else{

				$query = "SELECT * FROM tbl_admin WHERE adminuser = '$adminuser' AND adminpass = '$adminpass' ";
				$result = $this->db->select($query);

				if ($result != false) {
					$value = $result->fetch_assoc();

					Session::set("adminlogin", true);
					Session::set("adminuser", $value['adminuser']);
					Session::set("adminid", $value['adminid']);
					Session::set("adminname", $value['adminname']);
					header("Location:dashboard.php");
	
				}else{

					$loginmsg = "Username or Password  not match!";
					return $loginmsg;
				}


			}
 	}



 }

?>