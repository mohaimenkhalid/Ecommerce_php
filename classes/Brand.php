<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');

 ?>

<?php 

/**
 * Category class
 */
class Brand{
	
			private $db;
		 	private $fm;
		 	
		 	public function __construct(){

		 		$this->db = new Database();
				$this->fm = new Format();
		 		
		 	}




public function brandinsert($brandname){

 		$brandname = $this->fm->validation($_POST['brandname']);
 		$brandname = mysqli_real_escape_string($this->db->link, $brandname);
		
		if (empty($brandname)) {
			$msg = "<span style='color:red; font-size:18px; '>Brand field must not be empty! </span>";
			return $msg;
		}else{

			$query = "INSERT INTO tbl_brand(brandname) VALUES('$brandname') ";
			$brandinsert = $this->db->insert($query);

			if ($brandinsert != false) {

				$msg = "<span style='color:green; font-size:18px;' >Brand inserted successfully!</span>";
				return $msg;
				
			}else{

				$msg = "<span style='color:red; font-size:18px; '>Brand not inserted !</span>";
				return $msg;
			}

		}
 	}



 	public function getallbrand(){

 		$query = "SELECT * FROM tbl_brand ORDER BY 'brandid' DESC";
 		$result = $this->db->select($query);
 		return $result;
 	}


 	public function getbrandbyid($id){

 		$query = "SELECT * FROM tbl_brand WHERE brandid = '$id' ";
 		$result = $this->db->select($query);
 		return $result;
 	}


 	public function brandupdate($brandname, $id){

 		if (empty($brandname)) {
			$msg = "<span style='color:red; font-size:18px; '>Brand field must not be empty! </span>";
			return $msg;
		}

		else{

 		$query = "UPDATE tbl_brand SET brandname = '$brandname' WHERE brandid = '$id' ";
 		$result = $this->db->update($query);

 		if ($result != false) {

				$msg = "<span style='color:green; font-size:18px;' >Brand Name updated successfully!</span>";
				return $msg;
				
			}else{

				$msg = "<span style='color:red; font-size:18px; '>Brand Name is not updated inserted !</span>";
				return $msg;
			}
 	}

 }



 public function delbrandbyid($id){

 		$query = "DELETE  FROM tbl_brand WHERE brandid = '$id' ";
 		$result = $this->db->delete($query);

 		if ($result != false) {

				$msg = "<span style='color:green; font-size:18px;' >Brand Item Deleted successfully!</span>";
				return $msg;
				
			}else{

				$msg = "<span style='color:red; font-size:18px; '>Brand Item is not Deleted !</span>";
				return $msg;
			}
 	}

 }


?>