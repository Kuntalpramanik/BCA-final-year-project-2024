<?php
require_once('config.php');
require_once('checksession.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashborad Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php require('menu.php') ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h2 class="mt-4">Add New Items</h2>
                        <div class="col-12">
                            <div class="col-6">
                                <?php
                                    $src="SELECT * FROM category";
                                    $rs=mysqli_query($con, $src)or die(mysqli_error($con));
                                ?>
                                <form name="frm" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="i_name">Item Name</label>
                                        <input type="text" name="i_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="i_desc">Item Decription</label>
                                        <input type="text" name="i_desc" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="i_price">Item Price</label>
                                        <input type="text" name="i_price" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="i_brand">Item Brand</label>
                                        <input type="text" name="i_brand" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="i_add_info">Item Additional Information</label>
                                        <input type="text" name="i_add_info" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="cat_id">Select Category</label>
                                        <select name="cat_id" class="form-control">
                                            <option value="">-Select Category-</option>
                                            <?php
                                            while($rec=mysqli_fetch_assoc($rs)){
                                                echo '<option value="'.$rec['cat_id'].'">'.$rec['cat_name'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ff">Select Image</label>
                                        <input type="file" name="ff" class="form-control">
                                    </div>
                                    <input type="submit" name="ok" value="Add Item" class="btn btn-primary">
                                </form>
                                <?php
                                if(isset($_POST['ok'])){
                                    $i_name=$_POST['i_name'];
                                    $i_desc=$_POST['i_desc'];
                                    $i_price=$_POST['i_price'];
                                    $i_brand=$_POST['i_brand'];
                                    $i_add_info=$_POST['i_add_info'];
                                    $cat_id=$_POST['cat_id'];
                                    $fname=$_FILES['ff']['name'];
                                    $fsize=$_FILES['ff']['size'];
                                    $ftype_arr=array('png','PNG','JPG','jpg','jpeg','JPEG','webp','WEBP');
                                    $fext_arr=explode(".",$fname);
                                    $fext=end($fext_arr);
                                    $img_path="item_img/".rand(00000000, 99999999)."_".$fname;
                                    if(in_array($fext, $ftype_arr)){
                                        if($fsize<(1024*1024*2)){
                                            if(move_uploaded_file($_FILES['ff']['tmp_name'],$img_path)){
                                                $sql="INSERT INTO item (i_name, i_desc, i_price, i_img, i_brand, i_add_info, cat_id) VALUES ('$i_name', '$i_desc', '$i_price', '$img_path', '$i_brand', '$i_add_info', $cat_id)";
                                                $res=mysqli_query($con, $sql) or die(mysqli_error($con));
                                                if($res==1){
                                                    echo 'Item add successfully';
                                                }else{
                                                    echo 'Item could not add successfully';
                                                }

                                            }else{
                                                echo "Not successfull";
                                            }
                                        }else{
                                            echo "Please select less than 2MB image file";

                                        }
                                    }else{
                                        echo "Please select only image file";
                                    }
                                    
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
                <?php require('footer.php') ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
