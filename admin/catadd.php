﻿<?php include '../classes/Category.php'; ?>


<?php 

      $cat = new Category();    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            $catname = $_POST['catname'];

            $insertcat = $cat->catinsert($catname);

            
    }

?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
              <h2>Add New Category</h2>
<?php

    if (isset($insertcat)) {
        echo $insertcat;
    }
    
    ?>
         
               <div class="block copyblock"> 
        <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catname" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Add Category" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>