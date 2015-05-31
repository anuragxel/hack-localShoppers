<?php
session_start();

if(!isset($_SESSION['user_is_logged'])) {
	header('Location: '.$base_url.'/index.html');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $_SESSION['user_name'] ?> Profile - Local Shopper</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   	<style>
		#reg {
			display: inline;
		}
	</style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Local Shopper</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">  <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
				</li>
				
                    	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    	<div>
                    		<!-- <form action="logout.php" method="post">
                    			<input type="submit" value="Logout"/>
                    		</form> -->
                    		<h4><strong>Current Products in shop <?php echo $_SESSION['user_shop_name'] ?></strong></h4>
                    		<div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-striped">
                            	<thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price (in Rs.)</th>
                                            <th>Delete?</th>
                                        </tr>
                                    </thead>
                                <tbody>
                    		<?php
                    			require_once('/var/www/html/prod_init.php');
                    			$cps = new CPS_Simple($cpsProdConn);
                    			$query = CPS_Term($_SESSION['user_id'],'shop_id');
                    			$records = $cps->search($query);
                    			foreach($records as $id => $record) {
                    				echo "<tr>";
                    				echo "<td>".$record->prod_name."</td>";
                    				echo "<td>".$record->price."</td>";
                    				echo "<td><a href='deleteProduct.php?prod_id=".$record->id."'>Delete</a></td>";
                    				echo "</tr>";
                    				echo "\n";
                    			}
                    		?>
                    	</tbody>
                    		</table>
                    		</div>
                    		</div>
                    		<h4><strong>Add Product to shop <?php echo $_SESSION['user_shop_name'] ?></strong></h4>
                    		<form id="addProduct" action="addProduct.php" method="post" role='form'>

                    			<div class="form-group">
                    			    <label>Product Name</label>
                    			    <input type=text name="prod_name" placeholder="Product Name" class="form-control">
                    			</div>
                    			<div class="form-group">
                    			    <label>Price</label>
                    			    <input type=text name="price" placeholder="0" class="form-control" />
                    			</div>
                    			<input type=submit value="Submit" class="btn btn-default"/>
                    		</form>
                    	</div>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
   		</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script> 
</body>
</html>