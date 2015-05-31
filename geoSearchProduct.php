<html>
	<head>
		<title>Search Products Nearby</title>
		<script src="http://maps.google.com/maps/api/js?sens or=true&.js"></script>
		<style>
			#map_canvas {
				width: 400px;
				height: 300px;
			}
		</style>
	</head>
	<body>
			<?php
				require_once('/var/www/html/cps_simple.php');

				$connectionStrings = array(	
				  'tcp://cloud-us-0.clusterpoint.com:9007',	
				  'tcp://cloud-us-1.clusterpoint.com:9007',	
				  'tcp://cloud-us-2.clusterpoint.com:9007',	
				  'tcp://cloud-us-3.clusterpoint.com:9007',	
				);

				$admin_user = 'yashdbest01@gmail.com';
				$admin_pass = 'vardhan0307';
				$cpsProdConn = new CPS_Connection(new CPS_LoadBalancer($connectionStrings), 'localproducts', $admin_user, $admin_pass, 'document', '//document/id', array('account' => 100236));
				
				$cpsProd = new CPS_Simple($cpsProdConn);
				
				echo $_POST['prod_name'];
				$query = CPS_Term($_POST['prod_name'], 'prod_name');
				$shop_records = $cpsProd->search($query);

				$shops_to_retrieve = array();
				$len = count($shop_records);
				for($i=1;$i<=$len;$i++) {
					$shops_to_retrieve[$i] = (string)$shop_records[$i]->shop_id;
				}
				
				$cpsConn = new CPS_Connection(new CPS_LoadBalancer($connectionStrings), 'localshopper', $admin_user, $admin_pass, 'document', '//document/id', array('account' => 100236));	
				$cps = new CPS_Simple($cpsConn);

				$shops_info = $cps->retrieveMultiple($shops_to_retrieve);
				$len = count($shops_info);
			?>
		<div id='map_canvas'></div>
		</div>
		<script>
		(function() {
	    
	    	if(!!navigator.geolocation) {
	    	
	    		var map;
	    	
		    	var mapOptions = {
		    		zoom: 15,
		    		mapTypeId: google.maps.MapTypeId.ROADMAP
		    	};
		    	
		    	map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
	    	
	    		navigator.geolocation.getCurrentPosition(function(position) {
	    		
		    		var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		    	
		    		var myMarker = new google.maps.Marker({
		    			map: map,
		    			position: geolocate,
		       	 		draggable: false
					});
		
		    		map.setCenter(geolocate);
		    		
	    		});
	    		<?php 
	    			for($i=0;$i<$len;$i++) {
	    				
	    				echo "var myMarker".$i." = new google.maps.Marker({
		    			map: map,
		    			position: new google.maps.LatLng(".$shops_info[$i]->coordinates->lat.", ".$shops_info[$i]->coordinates->long."),
		       	 		draggable: false
						});";
						
						
						//echo "<td>".$shop_records[$i]->shop_id."</td>";
						//echo "<td>".$shops_info[$i]->id."</td>";
						//echo "<td>".$shop_records[$i]->price."</td>";
						//echo "<td>".$shops_info[$i]->coordinates->lat."</td>";
						//echo "<td>".$shops_info[$i]->coordinates->long."</td>";
						//echo "</tr>";
					}
				?>
	    		
	    	} else {
	    		document.getElementById('map_canvas').innerHTML = 'No Geolocation Support.';
	    	}
	    })();
	  </script>
	</body>
</html>
		