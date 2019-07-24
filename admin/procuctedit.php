<?php include '../classes/Product.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php 

if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
    echo "<script>window.location = 'productlist.php'; </script>";
}else{


    $id = $_GET['productid'];
}

?>

<?php 

    $product = new Product();    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
         $updateproduct = $product->productupdate($_POST, $_FILES , $id);   
            
    }

?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
              <h2>Update Product Item</h2>
                                 
         
               <div class="block "> 

     <?php

        if (isset($updateproduct)) {
            echo $updateproduct;
        }
    
    ?>
        <form action="" method="post" enctype="multipart/form-data">

            <table class="form">


                 <?php

                                $getproduct = $product->getproductbyid($id);
                                if ($getproduct) {
                                while ($presult = $getproduct->fetch_assoc()) {

                ?>

               
                <tr>

             <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productname" value="<?php echo $presult['productname'];  ?>"  class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catid">
                            <option>Select Category</option>
                            <?php 

                            $cat = new Category();
                            $getcat = $cat->getallcat();
                            if ($getcat) {
                                while ($result = $getcat->fetch_assoc()) {
                            ?>

                            <option

                            <?php 

                            if ($result['catname'] == $presult['catname']) {
                             ?>
                            selected= "selected"
                             <?php } ?>

                             value="<?php echo $result['catid']; ?>"><?php echo $result['catname']; ?></option>

                            <?php  } } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandid">
                            <option>Select Brand</option>
                            <?php 

                            $brand = new Brand();
                            $getbrand = $brand->getallbrand();
                            if ($getbrand) {
                                while ($result = $getbrand->fetch_assoc()) {
                              

                            ?>
                            <option 

                            <?php 

                            if ($result['brandname'] == $presult['brandname']) {
                             ?>
                            selected= "selected"
                             <?php } ?>

                            value="<?php echo $result['brandid']; ?>"><?php echo $result['brandname']; ?></option>

                            <?php  } } ?>
                            
                        </select>
                    </td>
                </tr>
                
                 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="body"  class="tinymce">   
                        <?php echo $presult['body'];  ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $presult['price'];  ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    
                    <td>
                        <img width="60" height="80" src="<?php echo $presult['image']; ?>"><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option
                             <?php 
                            if ($presult['type'] == '0') {
                             ?>
                            selected= "selected"
                             <?php } ?>
                             value="0">Featured</option>

                            <option 
                            <?php 
                            if ($presult['type'] == '1') {
                             ?>
                            selected= "selected"
                             <?php } ?>

                            value="1">General</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>

            <?php } } ?>
            </table>
            </form>
                </div>
            </div>
        </div>
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>

<?php include 'inc/footer.php';?>