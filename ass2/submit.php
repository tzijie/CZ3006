<?xml version = "1.0"  encoding = "utf-8" ?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  
<html xmlns = "http://www.w3.org/1999/xhtml">
  <head>
    <title> Order Receipt </title>
  </head>
  <body>
    <?php
// Get order data values
      $name = $_POST["name"];
	  $apples = $_POST["apples"];
      $oranges = $_POST["oranges"];
      $bananas = $_POST["bananas"];
      $payment = $_POST["payment"];

// If any of the quantities are blank, set them to zero
      if ($apples == "") $apples = 0;
      if ($oranges == "") $oranges = 0;
      if ($bananas == "") $bananas = 0;

// Compute item costs and total cost
      $apples_cost = 0.69 * $apples;
      $oranges_cost = 0.59 * $oranges;
      $bananas_cost = 0.39 * $bananas;
	  $total_cost=$apples_cost+ $oranges_cost+$bananas_cost;  
    ?>
	
    <p><h2> Order Receipt </h2></p>
    <?php print ("<strong>Customer Name :</strong> $name <br />");?>
    <p> </p>

    <table border = "border">
      <caption><strong> Order Information </strong></caption>
      <tr>
        <th> &nbsp Product &nbsp </th>
        <th> Unit Price </th>
        <th> Quantity </th>
        <th> Item Cost </th>
      </tr>
      <tr align = "center">
        <td> Apples </td>
        <td> $0.69 </td>
        <td> <?php print ("$apples"); ?> </td>
        <td> <?php printf ("$ %4.2f", $apples_cost); ?>
        </td>
      </tr>
      <tr align = "center">
        <td> Oranges </td>
        <td> $0.59 </td>
        <td> <?php print ("$oranges"); ?> </td>
        <td> <?php printf ("$ %4.2f", $oranges_cost); ?>
        </td>
        </tr>
      <tr align = "center">
        <td> Bananas </td>
        <td> $0.39 </td>
        <td> <?php print ("$bananas"); ?> </td>
        <td> <?php printf ("$ %4.2f", $bananas_cost); ?>
        </td>
      </tr>
	  	<tr align = "center" >
        <td colspan="2"><strong> &nbsp Payment method: &nbsp </strong>
        </td>
	<td colspan="2"> <?php printf ($payment); ?>
        </td>
      </tr>
	  <tr align = "center">
        <td colspan="2"><strong> Total : </strong>
        </td>
	<td colspan="2"> <?php printf ("$ %4.2f", $total_cost); ?>
        </td>
      </tr>
    </table>
    <p> </p>
	<a href="../Assignment2/index.html">Back to Order Form</a>
	
	<?php
      $apple = $_POST["apples"]; 
      $orange = $_POST["oranges"];
      $banana = $_POST["bananas"]; 
	  $file = 'order.txt';

	//checks if file exists
	if(file_exists($file)){
		if($fhandle = fopen($file,"r")){
		//tests if at EOF, break if at EOF
			while (!feof($fhandle)){
				$contents[] = fgets($fhandle);
				}
			fclose($fhandle);
			}
		} else {
			fopen($file,"c+");//create file if does not exist
		}
		
	 //opens the file and read line by line
	$myfile_line = file("order.txt" ); 
	
	//if it is an empty text file, fills every row with empty space to prevent error
	for ($x = 0; $x <= 10; $x++) {
		if(empty($myfile_line[$x]))
			$myfile_line[$x]=" ";
	} 

	//replaces anything which is not a number with "" line by line
    $apples_cumulative=preg_replace("/[^0-9]/","",$myfile_line[0]); 
	$oranges_cumulative=preg_replace("/[^0-9]/","",$myfile_line[1]); 
	$bananas_cumulative=preg_replace("/[^0-9]/","",$myfile_line[2]);	

	//sums the existing value in the text file and the newly entered value
	$apples_total=$apple+ (int)$apples_cumulative; 
	$oranges_total=$orange+(int)$oranges_cumulative; 
	$bananas_total=$banana+(int)$bananas_cumulative; 
	
	//contents to be written back to the file
	$apples_content="Total number of apples: $apples_total\r\n";
	$oranges_content="Total number of oranges: $oranges_total\r\n";
	$bananas_content="Total number of bananas: $bananas_total\r\n";
	
	//writes back into the file
	$file = fopen("order.txt","c");
	fwrite ($file,$apples_content);
	fwrite ($file,$oranges_content);
	fwrite ($file,$bananas_content);
	fclose($file);
    ?>
	
  </body>
</html>
