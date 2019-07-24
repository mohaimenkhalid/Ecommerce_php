<?php include '../classes/Category.php'; ?>
<?php 

if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location = 'catlist.php'; </script>";
}else{


    $id = $_GET['catid'];
}

?>

<?php 

      $cat = new Category();    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            $catname = $_POST['catname'];

            $updatecat = $cat->catupdate($catname, $id);
            
    }

?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
              <h2>Update Category</h2>
                                 
         
               <div class="block copyblock"> 
        <form action="" method="post">

            <?php

    if (isset($updatecat)) {
        echo $updatecat;
    }
    
    ?>
                    <table class="form">					
                        <tr>

                            <?php

                                $getcat = $cat->getcatbyid($id);
                                if ($getcat) {
                                while ($result = $getcat->fetch_assoc()) {

                                ?>

                            <td>
                                <input type="text" name="catname" value="<?php echo $result['catname'];  ?>"  class="medium" />
                            </td>

                             <?php } } ?>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update Category" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>