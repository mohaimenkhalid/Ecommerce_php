<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>

 <?php 

 /**
  * Product class
  */
 class Product{
 	
 	private $db;
 	private $fm;
 	
 	public function __construct(){

 		$this->db = new Database();
		$this->fm = new Format();
 		
 	}



 	public function productinsert($data, $file){


	 		$productname = $this->fm->validation($data['productname']);
	 		$productname = mysqli_real_escape_string($this->db->link, $productname);

	 		$catid = $this->fm->validation($data['catid']);
	 		$catid = mysqli_real_escape_string($this->db->link, $catid);

	 		$brandid = $this->fm->validation($data['brandid']);
	 		$brandid = mysqli_real_escape_string($this->db->link, $brandid);

	 		$body = $data['body'];
	 		$body = mysqli_real_escape_string($this->db->link, $body);

	 		$price = $this->fm->validation($data['price']);
	 		$price = mysqli_real_escape_string($this->db->link, $price);

	 		$type = $this->fm->validation($data['type']);
	 		$type = mysqli_real_escape_string($this->db->link, $type);


	 		//Image........

	 			$permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $file['image']['name'];
                $file_size = $file['image']['size'];
                $file_temp = $file['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;

                if ($productname == "" || $catid == "" || $brandid == "" || $body == "" || $price == "" || $type == "" || $file_name == "" ) {
                    $msg = "<span style='color:red;font-size:18px;'>Field must not be empty!!</span>";
                    return $msg;

                }
                elseif ($file_size >1048567) {
                         $msg = "<span style='color:red;font-size:18px;'>Image Size should be less then 1MB! </span>";
                         return $msg;
                }
                elseif (in_array($file_ext, $permited) === false) {
                         $msg = "<span style='color:red;font-size:18px;'>You can upload only:-" .implode(', ', $permited)."</span>";
                          return $msg;
                        }

                else{

                	move_uploaded_file($file_temp, $uploaded_image);

                	 $query = "INSERT INTO tbl_product(productname, catid, brandid, body, price, image, type) VALUES('$productname', '$catid', '$brandid',   '$body', '$price', '$uploaded_image', '$type' )" ;

                        $inserted_rows =$this->db->insert($query);

                         if ($inserted_rows) {
                         $msg = "<span style='color:green;font-size:18px;'>Product Inserted Successfully. </span>";
                         return $msg;
                        } else {
                         $msg = "<span style='color:red;font-size:18px;'>Product Not Inserted !</span>";
                         return $msg;
                        }
                }

 	}



 	public function getallproduct(){

 		$query = "SELECT  p.*,c.catname,b.brandname
 		FROM tbl_product as p, tbl_category as c, tbl_brand as b 
 		WHERE p.catid = c.catid AND  p.brandid = b.brandid
 		ORDER BY p.productid DESC";



	/* INNER JOIN
 		$query = "SELECT  tbl_product.*,tbl_category.catname,tbl_brand.brandname
 		FROM tbl_product
 		INNER JOIN tbl_category
 		ON tbl_product.catid = tbl_category.catid
 		INNER JOIN tbl_brand
 		ON tbl_product.brandid = tbl_brand.brandid
		ORDER BY tbl_product.productid DESC";
		*/
 		$result = $this->db->select($query);
 		return $result;
 	}

 	public function getproductbyid($id){


 		$query = "SELECT  p.*,c.catname,b.brandname
 		FROM tbl_product as p, tbl_category as c, tbl_brand as b 
 		WHERE p.productid = '$id' AND p.catid = c.catid AND  p.brandid = b.brandid";
 		$result = $this->db->select($query);
 		return $result;
 	}


 	public function productupdate($data, $file, $id){


 			$productname = $this->fm->validation($data['productname']);
	 		$productname = mysqli_real_escape_string($this->db->link, $productname);

	 		$catid = $this->fm->validation($data['catid']);
	 		$catid = mysqli_real_escape_string($this->db->link, $catid);

	 		$brandid = $this->fm->validation($data['brandid']);
	 		$brandid = mysqli_real_escape_string($this->db->link, $brandid);

	 		$body = $data['body'];
	 		$body = mysqli_real_escape_string($this->db->link, $body);

	 		$price = $this->fm->validation($data['price']);
	 		$price = mysqli_real_escape_string($this->db->link, $price);

	 		$type = $this->fm->validation($data['type']);
	 		$type = mysqli_real_escape_string($this->db->link, $type);


	 			$permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $file['image']['name'];
                $file_size = $file['image']['size'];
                $file_temp = $file['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;


	 		if ($productname == "" || $catid == "" || $brandid == "" || $body == "" || $price == "" || $type == "" ) {
                    $msg = "<span style='color:red;font-size:18px;'>Field must not be empty!!</span>";
                    return $msg;

                }
                
            else{

                	if ( $file_name == "") {

                	$query = "UPDATE tbl_product SET productname = '$productname', catid ='$catid', brandid = '$brandid', body = '$body', price = '$price', type = '$type' WHERE productid = '$id' ";

                        $inserted_rows =$this->db->insert($query);

                         if ($inserted_rows) {
                         $msg = "<span style='color:green;font-size:18px;'>Product Updated Successfully. </span>";
                         return $msg;
                        } else {
                         $msg = "<span style='color:red;font-size:18px;'>Product Not Updated !</span>";
                         return $msg;
                        }

                		
                	}else{

	                		if ($file_size >1048567) {
	                         $msg = "<span style='color:red;font-size:18px;'>Image Size should be less then 1MB! </span>";
	                         return $msg;
	               			 }
	               			 elseif (in_array($file_ext, $permited) === false) {
	                         $msg = "<span style='color:red;font-size:18px;'>You can upload only:-" .implode(', ', $permited)."</span>";
	                          return $msg;
	                        }

	                		else{


		                		move_uploaded_file($file_temp, $uploaded_image);

		                	 	$query = "UPDATE tbl_product SET productname = '$productname', catid ='$catid', brandid = '$brandid', body = '$body', price = '$price', image ='$uploaded_image', type = '$type' WHERE productid = '$id' ";

		                        $inserted_rows =$this->db->insert($query);

		                         if ($inserted_rows) {
		                         $msg = "<span style='color:green;font-size:18px;'>Product Updated Successfully. </span>";
		                         return $msg;
		                        } else {
		                         $msg = "<span style='color:red;font-size:18px;'>Product Not Updated !</span>";
		                         return $msg;
		                        }

	                        }
                	}

                	
                }

 	}


 	public function delproductbyid($id){

 		$query = "DELETE FROM tbl_product WHERE productid = '$id' ";
 		$result= $this->db->delete($query);
 		if ($result) {
		      $msg = "<span style='color:green;font-size:18px;'>Product Deleted Successfully. </span>";
		       return $msg;
		        } else {
		            $msg = "<span style='color:red;font-size:18px;'>Product Not Deleted !</span>";
		               return $msg;
		                }

 	}



    public function getfeaturedproduct(){

        $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productid  LIMIT 4 ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getnewproduct(){

        $query = "SELECT * FROM tbl_product  ORDER BY productid DESC LIMIT 4 ";
        $result = $this->db->select($query);
        return $result;
    }


    public function latestfromiphone(){


      $query = "SELECT * FROM tbl_product WHERE brandid = '3' ORDER BY productid DESC LIMIT 1 ";
      $result = $this->db->select($query);
      return $result;
    }

    public function latestfromdell(){


      $query = "SELECT * FROM tbl_product WHERE brandid = '1' ORDER BY productid DESC LIMIT 1 ";
      $result = $this->db->select($query);
      return $result;
    }

    public function latestfromsamsung(){


      $query = "SELECT * FROM tbl_product WHERE brandid = '2' ORDER BY productid DESC LIMIT 1 ";
      $result = $this->db->select($query);
      return $result;
    }

    public function latestfromlg(){


      $query = "SELECT * FROM tbl_product WHERE brandid = '5' ORDER BY productid DESC LIMIT 1 ";
      $result = $this->db->select($query);
      return $result;
    }



  public function getproductbycat($id){


    $query = "SELECT * FROM tbl_product WHERE catid = '$id' ";

    $result = $this->db->select($query);
      return $result;
  }



    public function insertcomparedata($customerid, $productid){

      $customerid = mysqli_real_escape_string($this->db->link, $customerid);
      $compareid = mysqli_real_escape_string($this->db->link, $productid);



         $chkquery = "SELECT * FROM tbl_compare WHERE  productid = '$productid' AND customerid = '$customerid' ";
          $getpro = $this->db->select($chkquery);

        if ($getpro) {

          $msg = "<span style='color:red;font-size:18px;'>Product already added to Compare!</span>";
          return $msg;

         }else{


        $squery = "SELECT * FROM tbl_product WHERE productid = '$productid' ";
        $result = $this->db->select($squery)->fetch_assoc();

        if ($result) {

            $productid = $result['productid'];
            $productname = $result['productname'];
            $price = $result['price'];
            $image = $result['image'];


          $query = "INSERT INTO tbl_compare(customerid, productid, productname, price, image ) VALUES('$customerid', '$productid', '$productname', '$price',  '$image' )";


            $inserted_rows = $this->db->insert($query);

           if ($inserted_rows) {
                             $msg = "<span style='color:green;font-size:18px;'>Product added to Compare</span>";
                             return $msg;
                            } else {
                             $msg = "<span style='color:red;font-size:18px;'>Not Added to Compare !</span>";
                             return $msg;
                            }

        }

      }

      
    }




    public function getcomparedata($customerid){
     

     $query = "SELECT * FROM tbl_compare WHERE customerid = '$customerid' ORDER BY id DESC";
     $result = $this->db->select($query);

     return $result;
    }


    public function delcomparedata($customerid){

        
        $query = "DELETE FROM tbl_compare WHERE customerid = '$customerid' ";
        $this->db->delete($query);

      }


 }

 ?>