<?php 
function displayOrders($customerId, $name) {
    $lines = file("orders.txt", FILE_IGNORE_NEW_LINES);
    $orders = [];
    foreach ($lines as $line){
        $eachLine = explode(',', $line);
        if(count($eachLine) == 5){
        $orders[] = $eachLine;
        }
    }
    $orderKeys = [
        'orderId',
        'customerId',
        'ISBN',
        'title',
        'category'
    ];
    $orderData = [];
    foreach ($orders as $order){
        $assoOrder = array_combine($orderKeys, $order);
        if($assoOrder['customerId']==$customerId){
            $orderData[] = $assoOrder;
        }
    }   
    if (empty($orderData)){
        echo "<div class='panel panel-danger spaceabove'>";
        echo " <h6>No orders for the customer.</h6>";
        echo "</div>";
        
    } else {
    echo "<div class='panel panel-danger spaceabove'>";
    echo "<div class='panel-heading'><h4>Orders for " . $name . "</h4></div>";
    echo "<table class='table'>";
    echo "<tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Category</th>
        </tr>";

    foreach ($orderData as $order) {
        echo "<tr>";
        echo "<td>" . $order['ISBN'] . "</td>";
        echo "<td>" . $order['title'] . "</td>";
        echo "<td>" . $order['category'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; 
   charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>Book Template</title>

   <link rel="shortcut icon" href="../../assets/ico/favicon.png">

   <!-- Google fonts used in this theme  -->
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic,700italic' rel='stylesheet' type='text/css'>  

   <!-- Bootstrap core CSS -->
   <link href="bootstrap3_bookTheme/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap theme CSS -->
   <link href="bootstrap3_bookTheme/theme.css" rel="stylesheet">


   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
   <script src="bootstrap3_bookTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_bookTheme/assets/js/respond.min.js"></script>
   <![endif]-->
</head>

<body>

<?php include 'book-header.inc.php'; ?>
   
<div class="container">
   <div class="row">  <!-- start main content row -->

      <div class="col-md-2">  <!-- start left navigation rail column -->
         <?php include 'book-left-nav.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 

      <div class="col-md-10">  <!-- start main content column -->
        
         <!-- Customer panel  -->
         <div class="panel panel-danger spaceabove">           
           <div class="panel-heading"><h4>My Customers</h4></div>
           <table class="table">
             <tr>
               <th>Name</th>
               <th>Email</th>
               <th>University</th>
               <th>City</th>
             </tr>
             <?php 
             $lines = file("customers.txt", FILE_IGNORE_NEW_LINES); // Read the file into an array, ignoring newline characters
             $customers = [];
             
             foreach ($lines as $line) {
                 $eachLine = explode(',', $line);
                 $customers[] = $eachLine;
             }
             $keys = [
                 'customerId',
                 'fName',
                 'lName',
                 'email',
                 'university',
                 'address',
                 'city',
                 'state',
                 'country',
                 'zip/postal',
                 'phone'
             ];
             $customerData = [];
             foreach ($customers as $customer){
                 $assocCustomer = array_combine($keys, $customer);
                 $customerData[] = $assocCustomer;
             }
             ?>
             <?php 
             foreach($customerData as $keys){
             echo "<tr>";
                echo "<th><a href=http://eunhas.sgedu.site/Book_Rep_CRM/BookRepCRM.php?customerId=". $keys['customerId'] .">" . $keys["fName"] . " " . $keys["lName"] ."</a></th>";
             	echo "<th>" . $keys["email"] . "</th>";
             	echo "<th>" . $keys["university"] . "</th>";
             	echo "<th>" . $keys["city"] . "</th>";
             echo "</tr>";
             }
			?>
           </table>
         </div>
          <!-- order panel  -->
            <?php if (isset($_GET["customerId"])){
                $customerId = $_GET["customerId"];
                $selectedCustomer = null;
                foreach($customerData as $customer){
                    if($customer['customerId'] == $customerId){
                        $selectedCustomer = $customer;
                        break;
                    }
                }
                if($selectedCustomer){
                    displayOrders($_GET["customerId"], $selectedCustomer['fName'] . " " . $selectedCustomer['lName']);
                }
            }?>
        </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end container -->
   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_bookTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_bookTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_bookTheme/assets/js/holder.js"></script>
</body>
</html>