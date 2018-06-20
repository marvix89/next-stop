<?php

include 'funzioni.php';

$data = new MysqlClass();
$data->connetti();


$latitude=$_GET['latitude'];
$longitude=$_GET['longitude'];
$compagnia=$_GET['compagnia'];
$linea=$_GET['linea'];
$timestamp= $_GET['timestamp'];
$messaggio=$_GET['messaggio'];
$face=$_GET['face'];
 
 
$SqlString = "insert into bus(compagnia,linea,timestamp,latitude,longitude,messaggio,face) values('".$compagnia."','".$linea."','".$timestamp."',".$latitude.",".$longitude.",'".$messaggio."','".$face."')";
$post_sql = $data->query($SqlString);


$data->disconnetti();

 ?>