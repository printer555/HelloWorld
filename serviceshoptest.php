<?php
 
// Create connection
//$con=mysqli_connect("localhost","username","password","dbname");
//test github
$con=mysqli_connect("localhost","root",'1234',"project_shop");
mysqli_set_charset($con, 'utf8'); 

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
//echo "Hello World <br>";


// This SQL statement selects ALL from the table 'Locations'
$sql = "SELECT shop_name,shop_pic,shop_detail,promo_name,promo_enddate,promo_detail,cat_name,shop_zone,shop_floor,promo_pic FROM (shop_info LEFT JOIN category_info ON(shop_info.cat_id=category_info.cat_id) LEFT JOIN promotion_info ON(shop_info.shop_id=promotion_info.shop_id AND promotion_info.promo_status='Active')))ORDER BY promo_startdate DESC, promo_enddate ASC"";
 
// Check if there are results
if ($result = mysqli_query($con, $sql))
{
	// If so, then create a results array and a temporary one
	// to hold the data
	$resultArray = array();
	$tempArray = array();
 
	// Loop through each row in the result set
	while($row = $result->fetch_object())
	//($row = $result->fetch_object())
	{
		//echo $row['cat_id']."<br>";
		//echo $row['cat_name']."<br>";
		// Add each row into our results array
		$tempArray = $row;
	    array_push($resultArray, $tempArray);
	}


 
	// Finally, encode the array to JSON and output the results
	echo json_encode($resultArray);
	

}


 
// Close connections
mysqli_close($con);
?>