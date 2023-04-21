<?php $categorypagemenu='active'; ?>

<?php include '../header.php'; ?>
<--!<?php include '../menu.php'; ?> -->
<?php
if (($_SESSION['UserRole']) != 'manager') {
    header("Location:../login.php");
}?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Manage Categories</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>category/add.php" class="btn btn-sm btn-outline-secondary">Add Category</a>

            </div>

        </div>
    </div>
    <?php
    $sql = "SELECT * FROM tbl_category";
    $db = dbConn();
    $result = $db->query($sql);

    $totalCategories = $result->num_rows;
    ?>
    <h5><span class="badge bg-primary"><?= $totalCategories ?></span> Categories</h5>
    <div class="table-responsive">

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Category description</th>
                    <th scope="col">Category Image</th>
                    <th scope="col">Status </th>                                    
                    <th scope="col">Add Date </th>
                    
        
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td width="50"><?= $i ?></td>
                            <td width="50"><?= $row['ProductName'] ?></td>
                            <td width="50"><?= $row['ProductDescription'] ?></td>
                            <td width="50"><img class="img-fluid" width="20"  src="<?= SYSTEM_PATH?>assets/images/categories/<?= $row['categoryimage'] ?>"></td>
                      
                              
                              <td width="50">
                            <?php
                            if ($row['Status'] == 1) {
                                ?>
                                 <p><a href="statuscategory.php?Id=<?= $row['Id']?>.&Status=0" class="text-success text-decoration-none">Active</a></p> <?php
                            } else {?>
                                <p><a href="statuscategory.php?Id=<?= $row['Id']?>.&Status=1" class="text-danger text-decoration-none">Deactive</a></p><?php
                            }
                            ?>
                            </td>
                              
                            <td width="50" ><?= $row['AddDate'] ?></td>   
                            
                                       <!--   <td width="50" ><?php
                                if($row['Status']== 1){echo '<p><a href="statuscategory.php?Id='.$row['Id'].'&Status=0" class="text-success">Active</a></p>';}
                                else{
                                    echo'<p><a href="statuscategory.php?Id='.$row['Id'].'&Status=1" class="text-danger">Dective</a></p>';
                                }
                                ?></td>  --> 
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php include '../footer.php'; ?>       