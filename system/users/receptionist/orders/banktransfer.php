<?php $product = 'active'; ?>
<?php include '../../../header.php'; ?>
<?php  include '../../../menu.php'; ?> 




<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Manage Orders</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>users/receptionist/orders/cod.php" class="btn btn-sm btn-outline-secondary">View COD oders</a>

                </div>
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>users/receptionist/orders/orders.php" class="btn btn-sm btn-outline-secondary">View All oders</a>

                </div>
             
                

            </div>
        </div>
        <?php
         $sql = "SELECT * FROM tbl_orders WHERE payementmethod='Bank_transfer' ";
        $db = dbConn();
        $result = $db->query($sql);

        $totalProducts = $result->num_rows;
        ?>
        <h5><span class="badge bg-primary"><?= $totalProducts ?></span> Products</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th  scope="col">Order ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Customer Contact </th>
                        <th scope="col">deliver Address</th>                                    
                        <th scope="col">deliver Address</th>
                        <th scope="col">Deliver City</th>
                        <th scope="col">Grand Total</th>
                        <th scope="col">Total Quantity</th>
                        <th scope="col">Total Discount</th>

                        <th scope="col">Payment Method</th>
                        <th scope="col">Order Status</th>
                         <th scope="col">Download image</th>
                          <th scope="col">show  image</th>
                          <th scope="col">change Status</th>
                  
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td  width="100"><?= $row['orderID'] ?></td>
                                <td  ><?= $row['CustomerName'] ?></td>
                                <td ><?= $row['customeremail'] ?></td>
                                <td ><?= $row['customercontact'] ?></td>
                                <td ><?= $row['deliveraddress'] ?></td>
                                <td ><?= $row['deliveraddress2'] ?></td>                                    
                                <td ><?= $row['delivercity'] ?></td>
                                <td ><?= $row['grandtotal'] ?></td>
                               <td ><?= $row['totalquantity'] ?></td>
                                <td><?= $row['totaldiscount'] ?></td>
                                <td><?= $row['payementmethod'] ?></td>
                                  
                                <td><?php if 
                                ($row['orderstatus']== NOT_PROCESSING ) { ?>
                                       <div style="background-color: #ff6666;"> Not Proccessed</div> <?php
                                    
                                }else if ($row['orderstatus']== PROCESSING){?>
                                       <div style="background-color: #ffff99"> Proccessing</div> <?php 
                                    
                                }else if ($row['orderstatus']== PACKED){?>
                                       <div style="background-color: #9999ff"> Packed</div> <?php 
                                    
                                }else if($row['orderstatus']== HAND_OVER_DELIVERY){?>
                                       <div style="background-color: #99ffff"> Handover to deliver</div> <?php 
                                    
                                }else if($row['orderstatus']== DELIVERED){?>
                                       <div style="background-color: #009966"> Delivered </div> <?php 
                                  
                                }else if($row['orderstatus']== CANCELLED){?>
                                       <div style="background-color: #cc0033"> Cancelled </div> <?php 
                                }
                                
                                ?>
                                </td> 
                             
                           
                                <td> <a href="downloads.php?orderID=<?= $row ['orderID']?>"> Download </a></td>
                                 <td width="50"><img class="img-fluid" width="20" src="<?= SYSTEM_PATH ?>assets/images/orders/<?= $row['bankslip'] ?>"></td>
                                   
                               <td>
                                    <form method="get" action="status.php" >
                                        <input type="hidden" name="orderID" value="<?= $row['orderID'] ?>">
                                        <select name="changestatus" >
                                            
                                            <option>--</option>
                                            
                                            <option value="<?= NOT_PROCESSING ?>">Processing</option>
                                            <option value="5">Rejected</option>
                                           
                                            
                                        </select>
                                        <button type="submit" >update </button>

                                    </form>
                                </td>
                            
                            
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


<?php include '../../../footer.php'; ?>       