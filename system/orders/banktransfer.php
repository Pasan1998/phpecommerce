<?php $orders = 'active'; ?>
<?php include '../header.php'; ?>
<?php  include '../menu.php'; ?> 




<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Manage Orders</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>orders/cod.php" class="btn btn-sm btn-outline-secondary">View COD oders</a>

                </div>
             
                

            </div>
        </div>
        <?php
        
        $sql = "SELECT * FROM tbl_orders,orderproducts  WHERE tbl_orders.orderID=orderproducts.orderID AND payementmethod='Bank_transfer'";
         //$sql = "SELECT * FROM tbl_orders WHERE payementmethod='Bank_transfer' ";
        $db = dbConn();
        $result = $db->query($sql);

        $totalProducts = $result->num_rows;
        ?>
        <h5><span class="badge bg-primary"><?= $totalProducts ?></span> Orders</h5>
        <div class="table-responsive">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th width="100" scope="col">Order ID</th>
                        <th scope="col">Customer Name</th>
                      
                        <th scope="col">Grand Total</th>
                        <th scope="col">Total Quantity</th>
                        <th scope="col">Total Discount</th>

                        <th scope="col">Payment Method</th>
                        <th scope="col">Order Status</th>
                         <th scope="col">Download image</th>
                          <th scope="col">show  image</th>
                   <th scope="col">Change Status</th>
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
                      
                                <td ><?= $row['grandtotal'] ?></td>
                               <td ><?= $row['totalquantity'] ?></td>
                                <td><?= $row['totaldiscount'] ?></td>
                                <td><?= $row['payementmethod'] ?></td>
                                  
                                <td><?php if 
                                ($row['orderstatusproduct']== 0 ) { ?>
                                       <div style="background-color: #ff6666;"> Not Proccessed</div> <?php
                                    
                                }else if ($row['orderstatusproduct']== 1){?>
                                       <div style="background-color: #ffff99"> Proccessing</div> <?php 
                                    
                                }else if ($row['orderstatusproduct']== 2){?>
                                       <div style="background-color: #9999ff"> Packed</div> <?php 
                                    
                                }else if($row['orderstatusproduct']== 3){?>
                                       <div style="background-color: #99ffff"> Handover to deliver</div> <?php 
                                    
                                }else if($row['orderstatusproduct']== 4){?>
                                       <div style="background-color: #009966"> Delivered </div> <?php 
                                  
                                }else{?>
                                       <div style="background-color: #cc0033"> Cancelled </div> <?php 
                                }
                                
                                ?>
                                </td> 
                             
                           
                                <td> <a href="downloads.php?orderID=<?= $row ['orderID']?>"> Download </a></td>
                                 
                                
                                <td width="50"><img class="img-fluid" width="20" src="<?= SYSTEM_PATH ?>assets/images/orders/<?= $row['bankslip'] ?>"></td>
             
                                
                                  <td>
                                    <form method="get" action="status_1.php" >
                                        <input type="text" name="orderID" value="<?= $row['orderID'] ?>">
                                          <input type="text" name="productid" value="<?= $row['productid'] ?>">
                                        <select name="changestatus" >
                                            <option>--</option>
                                         
                                            <option value="2">Packed</option>
                                            <option value="3">Hand Over Delivery</option>
                                            
                                           
                                            
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


<?php include '../footer.php'; ?>       