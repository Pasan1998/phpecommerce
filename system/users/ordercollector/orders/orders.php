<?php $product = 'active'; ?>
<?php include '../../../header.php'; ?>
<?php  include '../../../menu.php'; ?> 




<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <section>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3">Manage Products</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>orders/cod.php" class="btn btn-sm btn-outline-secondary">View COD oders</a>

                </div>
                <div class="btn-group me-2">
                    <a href="<?= SYSTEM_PATH ?>orders/banktransfer.php" class="btn btn-sm btn-outline-secondary">View BankTrans Orders</a>

                </div>
                

            </div>
        </div>
        <?php
        $sql = "SELECT * FROM tbl_orders WHERE orderstatus=1 ";
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
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer Name</th>
                        
                        <th scope="col">Grand Total</th>
                        <th scope="col">Total Quantity</th>
                        <th scope="col">Total Discount</th>

                        <th scope="col">Payment Method</th>
                        <th scope="col">Order Status</th>
                          <th scope="col">Update Status</th>
                  
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
                                <td  ><?= $row['orderID'] ?></td>
                                <td  ><?= $row['CustomerName'] ?></td>
                                
                                <td ><?= $row['grandtotal'] ?></td>
                               <td ><?= $row['totalquantity'] ?></td>
                                <td><?= $row['totaldiscount'] ?></td>
                                <td><?= $row['payementmethod'] ?></td>
                                   <td><?php if 
                                ($row['orderstatus']== 0 ) { ?>
                                       <div style="background-color: #ff6666;"> Not Proccessed</div> <?php
                                    
                                }else if ($row['orderstatus']== 1){?>
                                       <div style="background-color: #ffff99"> Proccessing</div> <?php 
                                    
                                }else if ($row['orderstatus']== 2){?>
                                       <div style="background-color: #9999ff"> Packed</div> <?php 
                                    
                                }else if($row['orderstatus']== 3){?>
                                       <div style="background-color: #99ffff"> Handover to deliver</div> <?php 
                                    
                                }else if($row['orderstatus']== 4){?>
                                       <div style="background-color: #009966"> Delivered </div> <?php 
                                  
                                }else{?>
                                       <div style="background-color: #cc0033"> Cancelled </div> <?php 
                                }
                                
                                ?>
                                </td> 
                                
                                <td>
                                    <form method="get" action="status.php" >
                                        <input type="hidden" name="orderID" value="<?= $row['orderID'] ?>">
                                        <select name="changestatus" >
                                            <option>--</option>
                                           
                                            <option value="2">Packed</option>
                                            <option value="3">Handover Delivery</option>
                                            
                                            
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
    <section>
        <h1> </h1>
              <?php
        $sql = "SELECT * FROM tbl_orders WHERE orderstatus=2 ";
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
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer Name</th>
                      
                        <th scope="col">Grand Total</th>
                        <th scope="col">Total Quantity</th>
                        <th scope="col">Total Discount</th>

                        <th scope="col">Payment Method</th>
                        <th scope="col">Order Status</th>
                  
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
                                <td  ><?= $row['orderID'] ?></td>
                                <td  ><?= $row['CustomerName'] ?></td>
                                
                                <td ><?= $row['grandtotal'] ?></td>
                               <td ><?= $row['totalquantity'] ?></td>
                                <td><?= $row['totaldiscount'] ?></td>
                                <td><?= $row['payementmethod'] ?></td>
                                   <td><?php if 
                                ($row['orderstatus']== 0 ) { ?>
                                       <div style="background-color: #ff6666;"> Not Proccessed</div> <?php
                                    
                                }else if ($row['orderstatus']== 1){?>
                                       <div style="background-color: #ffff99"> Proccessing</div> <?php 
                                    
                                }else if ($row['orderstatus']== 2){?>
                                       <div style="background-color: #9999ff"> Packed</div> <?php 
                                    
                                }else if($row['orderstatus']== 3){?>
                                       <div style="background-color: #99ffff"> Handover to deliver</div> <?php 
                                    
                                }else if($row['orderstatus']== 4){?>
                                       <div style="background-color: #009966"> Delivered </div> <?php 
                                  
                                }else{?>
                                       <div style="background-color: #cc0033"> Cancelled </div> <?php 
                                }
                                
                                ?>
                                </td> 
                                
<!--                                //how to change the order status according to -->
                                     <td>
                                    <form method="get" action="status.php" >
                                        <input type="hidden" name="orderID" value="<?= $row['orderID'] ?>">
                                        <select name="changestatus" >
                                            <option>--</option>
                                   
                                            <option value="2">Packed</option>
                                            <option value="3">Handover Delivery</option>
                                         
                                            
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

     <section>
        <h1> </h1>
              <?php
        $sql = "SELECT * FROM tbl_orders WHERE orderstatus=3 ";
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
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer Name</th>
                      
                        <th scope="col">Grand Total</th>
                        <th scope="col">Total Quantity</th>
                        <th scope="col">Total Discount</th>

                        <th scope="col">Payment Method</th>
                        <th scope="col">Order Status</th>
                  
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
                                <td  ><?= $row['orderID'] ?></td>
                                <td  ><?= $row['CustomerName'] ?></td>
                                
                                <td ><?= $row['grandtotal'] ?></td>
                               <td ><?= $row['totalquantity'] ?></td>
                                <td><?= $row['totaldiscount'] ?></td>
                                <td><?= $row['payementmethod'] ?></td>
                                   <td><?php if 
                                ($row['orderstatus']== 0 ) { ?>
                                       <div style="background-color: #ff6666;"> Not Proccessed</div> <?php
                                    
                                }else if ($row['orderstatus']== 1){?>
                                       <div style="background-color: #ffff99"> Proccessing</div> <?php 
                                    
                                }else if ($row['orderstatus']== 2){?>
                                       <div style="background-color: #9999ff"> Packed</div> <?php 
                                    
                                }else if($row['orderstatus']== 3){?>
                                       <div style="background-color: #99ffff"> Handover to deliver</div> <?php 
                                    
                                }else if($row['orderstatus']== 4){?>
                                       <div style="background-color: #009966"> Delivered </div> <?php 
                                  
                                }else{?>
                                       <div style="background-color: #cc0033"> Cancelled </div> <?php 
                                }
                                
                                ?>
                                
                             
                           
                             
                                
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