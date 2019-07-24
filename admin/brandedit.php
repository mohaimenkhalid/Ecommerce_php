<?php include '../classes/Brand.php'; ?>
<?php 

if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
    echo "<script>window.location = 'brandlist.php'; </script>";
}else{


    $id = $_GET['brandid'];
}

?>

<?php 

      $brand = new Brand();    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            $brandname = $_POST['brandname'];

            $updatebrand = $brand->brandupdate($brandname, $id);
            
    }

?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
              <h2>Update Brand</h2>
                                 
         
               <div class="block copyblock"> 
        <form action="" method="post">

     <?php

    if (isset($updatebrand)) {
        echo $updatebrand;
    }
    
    ?>
                    <table class="form">					
                        <tr>

                            <?php

                                $getbrand = $brand->getbrandbyid($id);
                                if ($getbrand) {
                                while ($result = $getbrand->fetch_assoc()) {

                                ?>

                            <td>
                                <input type="text" name="brandname" value="<?php echo $result['brandname'];  ?>"  class="medium" />
                            </td>

                             <?php } } ?>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update Brand Name" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>