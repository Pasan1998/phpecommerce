<?php $sucessstorymenu='active';?>
<?php include '../header.php'; ?>
<?php include '../menu.php'; ?> 

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Add New Success story</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="<?= SYSTEM_PATH ?>sucessstories/newsucessstory.php" class="btn btn-sm btn-outline-secondary">Add New Success story</a>
            </div>

        </div>
    </div>
 
    <section>
    <?php echo @$_SESSION['project_title']; ?>
        <?php
        $sql = "SELECT * FROM tbl_stories WHERE SuccessStatus=1";
        $db = dbConn();
        $result = $db->query($sql);

        $totalActiveSuccessstories = $result->num_rows;
        ?>
        <h5><span class="badge bg-primary"><?= $totalActiveSuccessstories ?></span> Active Success Stories</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Success id</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Description </th>                       
                        
                         <th scope="col">Status</th> 
                         <th scope="col">Customer Image</th> 
                         <th scope="col">Added User</th> 
                         <th scope="col">Added Date</th> 
                                                
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td width="100"><?= $i ?></td>
                                <td width="100" ><?= $row['SuccessID'] ?></td>
                                <td width="100" ><?= $row['CustomerName'] ?></td>
                                <td width="100"><?= $row['ProductName'] ?></td>
                                <td width="100"><?= $row['CustomerDescription'] ?></td>
                                <td width="100"><?= $row['SuccessStatus'] ?></td>
                                <td width="100"> <img class="img-fluid" width="50" height="20" src="<?= SYSTEM_PATH?>assets/images/stories/<?= $row['CustomerImage'] ?>"></td>                                    
                            
                                

                                <td width="100"><?= $row['AddUser'] ?></td>
                                <td width="100"><?= $row['AddDate'] ?></td>  
                                <td ><?php
                                if($row['SuccessStatus']== 1){echo '<p><a href="status.php?SuccessID='.$row['SuccessID'].'&SuccessStatus=0" class="text-success">Active</a></p>';}
                                else{
                                    echo'<p><a href="status.php?SuccessID='.$row['SuccessID'].'&SuccessStatus=1" class="text-danger">Dective</a></p>';
                                }
                                ?></td>  

                            </tr>
                        <?php
                            $i++;
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </section>
</main>