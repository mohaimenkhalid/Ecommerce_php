<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>

<?php 

/**
 * Category class
 */



class Category{
	
	private $db;
 	private $fm;
 	
 	public function __construct(){

 		$this->db = new Database();
		$this->fm = new Format();
 		
 	}

 	public function catinsert($catname){

 		$catname = $this->fm->validation($_POST['catname']);
 		$catname = mysqli_real_escape_string($this->db->link, $catname);
		
		if (empty($catname)) {
			$msg = "<span style='color:red; font-size:18px; '>Category field must not be empty! </span>";
			return $msg;
		}else{

			$query = "INSERT INTO tbl_category(catname) VALUES('$catname') ";
			$catinsert = $this->db->insert($query);

			if ($catinsert != false) {

				$msg = "<span style='color:green; font-size:18px;' >Category inserted successfully!</span>";
				return $msg;
				
			}else{

				$msg = "<span style='color:red; font-size:18px; '>Category not inserted !</span>";
				return $msg;
			}

		}
 	}


 	public function getallcat(){

 		$query = "SELECT * FROM tbl_category ORDER BY 'catid' DESC";
 		$result = $this->db->select($query);
 		return $result;
 	}


 	public function getcatbyid($id){

 		$query = "SELECT * FROM tbl_category WHERE catid = '$id' ";
 		$result = $this->db->select($query);
 		return $result;
 	}


 	public function catupdate($catname, $id){

 		$query = "UPDATE tbl_category SET catname = '$catname' WHERE catid = '$id' ";
 		$result = $this->db->update($query);

 		if ($result != false) {

				$msg = "<span style='color:green; font-size:18px;' >Category updated successfully!</span>";
				return $msg;
				
			}else{

				$msg = "<span style='color:red; font-size:18px; '>Category not updated inserted !</span>";
				return $msg;
			}
 	}



 	public function delcatbyid($id){

 		$query = "DELETE  FROM tbl_category WHERE catid = '$id' ";
 		$result = $this->db->delete($query);

 		if ($result != false) {

				$msg = "<span style='color:green; font-size:18px;' >Category Item Deleted successfully!</span>";
				return $msg;
				
			}else{

				$msg = "<span style='color:red; font-size:18px; '>Category Item is not Deleted !</span>";
				return $msg;
			}
 	}



}

?>