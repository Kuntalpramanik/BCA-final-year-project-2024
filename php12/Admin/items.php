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
                        <h2 class="mt-4">All Items</h2>
                        <div class="col-12">
                            <a href="addItems.php" class="btn btn-info">Add New Items</a>
                            <?php
                            $src="SELECT i.*, c.cat_name FROM item i INNER JOIN category c ON i.cat_id=c.cat_id";
                            $rs=mysqli_query($con, $src)or die(mysqli_error($con));
                            if(mysqli_num_rows($rs)>0){
                                ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th></th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Barnd</th>
                                            <th>Descriptons</th>
                                            <th>Additional Info</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                while($rec=mysqli_fetch_assoc($rs)){
                                    ?>
                                    <tr>
                                        <td><?php echo $rec['i_name'] ?></td>
                                        <td><img src="<?php echo $rec['i_img']; ?>" width="75" height="75"></td>
                                        <td><?php echo $rec['i_price'] ?></td>
                                        <td><?php echo $rec['cat_name'] ?></td>
                                        <td><?php echo $rec['i_brand'] ?></td>
                                        <td><?php echo $rec['i_desc'] ?></td>
                                        <td><?php echo $rec['i_add_info'] ?></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                    </tbody>
                                </table>
                                <?php
                            }else{
                                echo '<h2 class="text-center text-danger">No items found</h2>';
                            }
                            ?>
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
