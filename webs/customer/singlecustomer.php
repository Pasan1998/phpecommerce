<?php include '../header.php'; ?>
<?php include '../menu.php'; ?>
<link href="singlecustomer.css" rel="stylesheet" type="text/css"/>
<?php

if(!isset($_SESSION['CustomerId'])){
    header("Location:../signin/signin.php");
}

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
    $db = dbConn();
    $sql = "SELECT * FROM tbl_customers WHERE CustomerId='$CustomerId'";
    $results = $db->query($sql);
    $row = $results->fetch_assoc();

    echo $CustomerId;
}
?>
<!--<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3"><?= $row['FirstName'] . " " . $row['LastName'] ?> </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="addUser.php" class="btn btn-sm btn-outline-secondary">Add Users</a>                               
            </div>
            <div class="btn-group me-2">
                <a href="addUser.php" class="btn btn-sm btn-outline-secondary">Password reset Request</a>                               
            </div>
            <div class="btn-group me-2">
                <a href="../products.php" class="btn btn-sm btn-outline-secondary">View Users</a>                               
            </div>
            <div class="btn-group me-2">
                <a href="../products.php" class="btn btn-sm btn-outline-secondary">Update Users</a>                               
            </div>

        </div>
    </div>
  
    
   
    <br>
customer name : <?= $row['FirstName'] . " " . $row['LastName'] ?>
   <br>
customer email : <?= $row['Email'] ?>
   <br>
Customer NIC:<?= $row['NIC'] ?>
   <br>
Customer Mobile: <?= $row['Mobile'] ?>
   <br>
Customer Address: <?= $row['Address'] ?>
   <br>
Customer City: <?= $row['City'] ?>
   <br>








</main>-->

<main>

    <div class="section-title" data-aos="fade-up">
        <h2>About Us</h2>
    </div>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container bootstrap snippets bootdey col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="row">
            <div class="profile-nav col-md-4">
                <div class="panel">
                    <div class="user-heading round">
                        <a href="#">
                            <img class="img-fluid" width="20" src="../../../assets/images/customers/<?= $row['CustomerImage'] ?>">
                        </a>
                        <h1><?= $row['FirstName'] . " " . $row['LastName'] ?></h1>
                        <p><?= $row['Email'] ?></p>
                    </div>
                    <div class="columne">
                        <div class="row">dasd</div>
                        <div class="row">asd</div>
                        <div class="row">das</div>
                        <li class="active"><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-warning pull-right r-activity">9</span></a></li>
                            <li><a href="#"> <i class="fa fa-edit"></i> Edit profile</a></li>
                    </div>

            </div>
        </div>
        <div class="profile-info col-md-8">

            <div class="panel">
                <div class="bio-graph-heading col-lg-12">
                    Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                </div>
                <div class="panel-body bio-graph-info">
                    <h1>Bio Graph</h1>
                    <div class="row">
                        <div class="bio-row">
                            <p><span>First Name </span>:<?= $row['FirstName'] ?></p>
                        </div>
                        <div class="bio-row">
                            <p><span>Last Name </span>:<?= $row['LastName'] ?> </p>
                        </div>
                        <div class="bio-row">
                            <p><span>Country </span>:<?= $row['Gender'] ?> </p>
                        </div>
                        <div class="bio-row">
                            <p><span>Birthday</span>: <?= $row['Address'] ?> </p>
                        </div>
                        <div class="bio-row">
                            <p><span>Occupation </span>:  <?= $row['City'] ?> </p>
                        </div>
                        <div class="bio-row">
                            <p><span>Email </span>: <?= $row['Email'] ?></p>
                        </div>
                        <div class="bio-row">
                            <p><span>Mobile </span>: <?= $row['Mobile'] ?></p>
                        </div>
                        <div class="bio-row">
                            <p><span>Phone </span>: <?= $row['FirstName'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-6 bg-white">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="bio-chart">
                                    <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="35" data-fgcolor="#e06b7d" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(224, 107, 125); padding: 0px; -webkit-appearance: none; background: none;"></div>
                                </div>
                                <div class="bio-desk">
                                    <h4 class="red">Envato Website</h4>
                                    <p>Started : 15 July</p>
                                    <p>Deadline : 15 August</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 bg-light">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="bio-chart">
                                    <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="63" data-fgcolor="#4CC5CD" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(76, 197, 205); padding: 0px; -webkit-appearance: none; background: none;"></div>
                                </div>
                                <div class="bio-desk">
                                    <h4 class="terques">ThemeForest CMS </h4>
                                    <p>Started : 15 July</p>
                                    <p>Deadline : 15 August</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 bg-light">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="bio-chart">
                                    <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="75" data-fgcolor="#96be4b" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(150, 190, 75); padding: 0px; -webkit-appearance: none; background: none;"></div>
                                </div>
                                <div class="bio-desk">
                                    <h4 class="green">VectorLab Portfolio</h4>
                                    <p>Started : 15 July</p>
                                    <p>Deadline : 15 August</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 bg-white">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="bio-chart">
                                    <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="50" data-fgcolor="#cba4db" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(203, 164, 219); padding: 0px; -webkit-appearance: none; background: none;"></div>
                                </div>
                                <div class="bio-desk">
                                    <h4 class="purple">Adobe Muse Template</h4>
                                    <p>Started : 15 July</p>
                                    <p>Deadline : 15 August</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
<?php  print_r($CustomerId);?>
<?php  include '../footer.php '?>