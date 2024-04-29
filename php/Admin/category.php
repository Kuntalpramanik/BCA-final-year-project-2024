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
                        <h2 class="mt-4">All Categories</h2>
                        <div class="col-12">
                            <div class="col-6">
                                <form name="cat-frm" method="post">
                                    <div class="form-group">
                                        <label for="cat_name">Category Name</label>
                                        <input type="text" name="cat_name" class="form-control">
                                    </div>
                                    <input type="submit" name="ok" value="Add Category" class="btn btn-primary">
                                </form>
                                <?php
                                if(isset($_POST['ok'])){
                                    $cat_name=$_POST['cat_name'];
                                }
                                ?>
                            </div>
                            <?php
                            $src="SELECT * FROM category";
                            $rs=mysqli_query($con, $src)or die(mysqli_error($con));
                            if(mysqli_num_rows($rs)>0){
                                ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while($rec=mysqli_fetch_array($rs)){
                                            ?>
                                            <tr>
                                                <td><?php echo $rec['cat_name']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            }else{
                                echo '<h2 class="text-center text-danger">No category found</h2>';
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
