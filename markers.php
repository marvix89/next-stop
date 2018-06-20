<?php

include 'funzioni.php';


$data = new MysqlClass();
$data->connetti();



$compagnia=$_GET['compagnia'];
$linea=$_GET['linea'];
$timestamp=$_GET['timestamp'];

 $faces=array();
 
$SqlString = "SELECT face from bus where compagnia='".$compagnia."' AND linea='".$linea."' ";
$post_sql = $data->query($SqlString);
$i=0;
if (mysql_num_rows($post_sql) > 0) {
    while ($post_obj = $data->estrai($post_sql)) {
      $faces[$i]=$post_obj->face;
	  $i++;
	}
}

echo json_encode($faces);
	$data->disconnetti();

 ?>