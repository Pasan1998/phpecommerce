<?php session_start(); ?>
<!--<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">-->
    <!--<label>Enter Qty:</label>
    <input type="text" name="qty" id="qty">
    <label>Enter Amount(Rs.)</label>
    <input type="text" name="amount" id="amount">
    <button type="submit">Process Bill</button>
    -->
<!--    <button type="submit">Play</button>-->
<!--</form>-->


<?php

/*
  $noofitem=@$_POST['qty'];
  $amount=@$_POST['amount'];

  if(!$noofitem && !$amount){
  echo "Data should be entered";
  } else {

  $peritemavg=$amount/$noofitem;


  if($peritemavg>=5000 && $noofitem>=4){
  $discount = ($amount*5/100) ;
  echo "Amount (Rs.) :"." ".$amount;
  echo "<br>";
  echo "Discount 5% (Rs.) :"." ".$discount;
  echo "<br>";
  echo "Discounted Amount (Rs.) :"." ".$amount-$discount;

  }else  {
  $discount = ($amount*1/100) ;
  echo "Amount (Rs.) :"." ".$amount;
  echo "<br>";
  echo "Discount 1% (Rs.) :"." ".$discount;
  echo "<br>";
  echo "Discounted Amount (Rs.) :"." ".$amount-$discount;
  }
  }

 */

/*
  $score= rand(0,4);

  if($score===0){
  echo '0 points, try again';
  }elseif ($score===1) {
  echo '1 point, try more';
  }elseif ($score===2) {
  echo '2 points, Nice';
  }elseif ($score===3) {
  echo '3 points, one more to reach the best';
  }elseif ($score===4) {
  echo '4 points, You won';
  }
 */

//$first_name="";
//
//$msg = !$first_name?"The first name should enter":"" ;
//echo $msg;
//date_default_timezone_set("Asia/Colombo");
//echo date_default_timezone_get();
//echo "<br>";
//echo date('G')<12?"Good Morning":"Welcome";
//echo "<br>";
//echo date("j \of\ F Y, \a\\t g.i.a", time());
//$students=array("Jin","jk","Jimin","Rm");
//
//foreach ($students as $key=>$value){
//    echo $key."-"." ".$value;
//    echo "<br>";
//}
//echo "count is"." ". count($students);
//echo "<br>";
//echo $students[3];
//echo "<br>";
//
//for($i=0;$i<count($students);$i++){
//    echo $students[$i];
//    echo "<br>";
//}
//
//$person[0]="jk";
//$person[1]="Rm";
//$person[2]="jin";
//$person[3]="Jimin";
//
//print_r($person);
//$salary=array("Name"=>"Jk","Basic Salary"=>45600,"Alowances"=>"6750","Advance"=>"5000");
////print_r($salary);
////echo "<br>";       
////echo $salary['Basic Salary'];
//
//
//foreach ($salary as $key=>$value){
//    echo $key."-".$value;
//    echo "<br>";
//}
//$products = array(
//    array('Tea', '1500', '500'),
//    array('Milk', '2500', '800'),
//    array('Coffee', '1500', '400')
//);
//
//echo "<table border='1' width='100%'>";
//echo "<tr><th>Product</th><th>Qty</th><th>Sold</th><th>Remaining</th>";
//for ($i = 0; $i < count($products); $i++) {
//    echo "<tr>";
//
//    for ($x = 0; $x < count($products[$i]); $x++) {
//        echo "<td>";
//        echo $products[$i][$x];
//        echo "</td>";
//    }
//    echo "<td>";
//    echo $products[$i][1]-$products[$i][2];
//    echo "</td>";
//    echo "</tr>";
//}
//echo "</table>";
//ascending order
//$person=array("did","bibi","cici","nivi");
//sort($person);
//
//foreach ($person as $value){
//    echo $value;
//    echo "<br>";
//}
//function calInput ($x,$y){
//    
//    
//    $z= $y-$x;
//    echo $z;
//}
//
//calInput(300,650);

//function calDistance($town1, $town2) {
//
//    $city = array("Colombo" => 16, "Nittambuwa" => 57, "Kadawatha" => 12, "Kandy" => 80, "Kegalle" => 120);
//
//    if ($city[$town2] > $city[$town2]) {
//        $distance = $city[$town2] - $city[$town2];
//    } else {
//        $distance = $city[$town1] - $city[$town2];
//    }
//
//    echo $distance;
//}
//
//calDistance("Kegalle", "Kadawatha");

//function calDistance($city1 = null, $city2 = null) {
//
//    $city = array("Colombo" => 0, "Kadawatha" => 16, "Nittambuwa" => 47, "Kegalle" => 85, "Kandy" => 122);
//    $distance = 0;
//    if (!empty($city1) && !empty($city2)) {
//        if ($city[$city1] > $city[$city2]) {
//            $distance = $city[$city1] - $city[$city2];
//        } else {
//            $distance = $city[$city2] - $city[$city1];
//        }
//    }else{
//        echo "Please enter cities...!";
//    }
//    return $distance;
//}

//function calDistance($city1 = null, $city2 = null) {
//
//    $city = array("Colombo" => 0, "Kadawatha" => 16, "Nittambuwa" => 47, "Kegalle" => 85, "Kandy" => 122);
//    $distance = 0;
//    if (!empty($city1) && !empty($city2)) {
//        if ($city[$city1] > $city[$city2]) {
//            $distance = $city[$city1] - $city[$city2];
//        } else {
//            $distance = $city[$city2] - $city[$city1];
//        }
//    }else{
//        echo "Please enter cities...!";
//    }
//    echo $distance;
//}
//
//calDistance("Colombo","Nittambuwa");

//print_r($_SERVER);
//echo count($_SERVER);

//$_SESSION['project_title']="BIT Project";

//class Student{
//    
//    $name="Nimal";
//    $address="Colombo";
//    
//}


?>

<a href="register.php?title=Customer Registration&page=two&role=teacher">Register</a>