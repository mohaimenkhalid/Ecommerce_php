<?php 

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');

 ?>

<?php 

	/**
	 * User Class
	 */
class Customer{

			private $db;
		 	private $fm;
		 	
		 	public function __construct(){

		 		$this->db = new Database();
				$this->fm = new Format();
		 		
		 	}

		 public function customerregistration($data){

			 $name = $this->fm->validation($data['name']);
			 $address = $this->fm->validation($data['address']);
			 $city = $this->fm->validation($data['city']);
			 $country = $this->fm->validation($data['country']);
			 $zip = $this->fm->validation($data['name']);
			 $email = $this->fm->validation($data['email']);
			 $phone = $this->fm->validation($data['phone']);
			 $password = $this->fm->validation(md5($data['password']));
			 
			 $name = mysqli_real_escape_string($this->db->link, $name);
			 $address = mysqli_real_escape_string($this->db->link, $address);
			 $city = mysqli_real_escape_string($this->db->link, $city);
			 $country = mysqli_real_escape_string($this->db->link, $country);
			 $zip = mysqli_real_escape_string($this->db->link, $zip);
			 $email = mysqli_real_escape_string($this->db->link, $email);
			 $phone = mysqli_real_escape_string($this->db->link, $phone);
			 $password = mysqli_real_escape_string($this->db->link, $password);
			

		if (empty($name) || empty($address) || empty($city) || empty($country) || empty($zip) || empty($email) || empty($phone) || empty($password) ) {
			$msg = "<span style='color:red; font-size:18px'>Field must not be empty! </span>";
			return $msg;
		}

        else{

        	$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND phone = '$phone' "; 
        	$result = $this->db->select($query);

        	if ($result !=false) {

        		$msg = "<span style='color:red; font-size:18px'>Email or phone already used! Use new one! </span>";
				return $msg;   
        	}else{

        		$query = "INSERT INTO tbl_customer(name, address, city, country, zip, email, phone, password) VALUES('$name', '$address', '$city', '$country', '$zip', '$email', '$phone', '$password' )";

				$result = $this->db->insert($query);

				if ($result != false) {
					
					$msg = "<span style='color:green; font-size:18px'>Registration successfully ! </span>";
					return $msg;
	
				}else{

					$msg = "Something wrong! Try again later!";
					return $msg;
				}

			}
        	    	
        }

		

		 }



		 public function customerlogin($data){

		 	$email = $this->fm->validation($data['email']);
			$password = $this->fm->validation(md5($data['password']));

			$email = mysqli_real_escape_string($this->db->link, $email);
			$password = mysqli_real_escape_string($this->db->link, $password);

			if (empty($email) || empty($password) ) {
			$msg = "<span style='color:red; font-size:18px'>Field must not be empty! </span>";
			return $msg;
			}

			$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password' "; 
        	$result = $this->db->select($query);

        	if ($result != false) {
        		
        		$value = $result->fetch_assoc();
        		Session::set("customerlogin", true );
        		Session::set("customerid", $value['id'] );
        		Session::set("customername", $value['name'] );
        		$sid = session_id();
        		$customerid = $value['id'];
        		$query = " UPDATE tbl_cart SET customerid = '$customerid' WHERE sid = '$sid' ";
        		$this->db->update($query);

        		header("Location:cart.php");
        	}else{

        		$msg = "<span style='color:red; font-size:18px'>Email or Password not matched ! </span>";
					return $msg;
        	}
			


		 }




		 public function getcustomerdata($id){

		 	$query = " SELECT * FROM tbl_customer WHERE id = '$id' ";
		 	$result = $this->db->select($query);
		 	return $result;

		 }


		 public function updateprofiledata($data, $id){


		 	 $name = $this->fm->validation($data['name']);
			 $address = $this->fm->validation($data['address']);
			 $city = $this->fm->validation($data['city']);
			 $country = $this->fm->validation($data['country']);
			 $zip = $this->fm->validation($data['name']);
			 $email = $this->fm->validation($data['email']);
			 $phone = $this->fm->validation($data['phone']);
			 
			 $name = mysqli_real_escape_string($this->db->link, $name);
			 $address = mysqli_real_escape_string($this->db->link, $address);
			 $city = mysqli_real_escape_string($this->db->link, $city);
			 $country = mysqli_real_escape_string($this->db->link, $country);
			 $zip = mysqli_real_escape_string($this->db->link, $zip);
			 $email = mysqli_real_escape_string($this->db->link, $email);
			 $phone = mysqli_real_escape_string($this->db->link, $phone);
			

		if (empty($name) || empty($address) || empty($city) || empty($country) || empty($zip) || empty($email) || empty($phone) ) {
			$msg = "<span style='color:red; font-size:18px'>Field must not be empty! </span>";
			return $msg;
		}else{



			$query = "UPDATE tbl_customer
					SET 
					name = '$name',
					address = '$address',
					city = '$city',
					country = '$country',
					zip = '$zip',
					email = '$email',
					phone = '$phone'
					WHERE id = '$id';";

				$update = $this->db->update($query);
				if ($update) {
					
					$msg = "<span style='color:green; font-size:18px'>Profile Data Updated successfully ! </span>";
					return $msg;
	
				}else{

					$msg = "<span style='color:red; font-size:18px'>Profile Data Not Updated successfully ! </span>";
					return $msg;
				}


		}


		 }


		 public function updatepassword($data, $id){

		$oldpass = $this->fm->validation($data['oldpass']);
		$newpass = $this->fm->validation($data['newpass']);
		$oldpass = mysqli_real_escape_string($this->db->link, $oldpass);
		$newpass = mysqli_real_escape_string($this->db->link, $newpass);


		 	if ( $oldpass == "" || $newpass == "" ) {

           			$msg =  "<span style=' color:red;font-size:18px;'>Field must not be empty!!</span>";
           			return $msg;
      		 }



      		 else {

      		 	$oldpass = md5($oldpass);
      		 	$newpass = md5($newpass);


                   $query = "SELECT password FROM tbl_customer WHERE password = '$oldpass' AND id = '$id' "; 
                   $result = $this->db->select($query);

                   if($result !=false){

                                   $updatequery = "UPDATE tbl_customer SET password = '$newpass' WHERE  id = '$id' ";
                                   $update =$this->db->update($updatequery);

                                   if ($update !=false) {

                                       $msg = "<span style='color:green;font-size:18px;'>Password update successfully!!</span>";
                                       return $msg;

                                   }else {

                                        $msg = "<span style='color:red;font-size:18px;'>Password not updated !</span>";
                                        return $msg;
                                   }

                    	} else {

	                       $msg = "<span style='  color:red;font-size:18px;'>Old password does not contain!</span>";
	                       return $msg;
                            
                            }

                           

           }




		 }


	
	}

?>