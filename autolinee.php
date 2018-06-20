<?php

include 'funzioni.php';


$data = new MysqlClass();
$data->connetti();

$compagnia=$_GET['compagnia'];
 
$SqlString = "SELECT id,linea from autolinee where compagnia='".$compagnia."'";
$post_sql = $data->query($SqlString);
if (mysql_num_rows($post_sql) > 0) {
    while ($post_obj = $data->estrai($post_sql)) {
  
  ?>
  <option value="<?=$post_obj->id?>">
  <?=$post_obj->linea?>
  </option>
  
  <?php
	}
}
$data->disconnetti();

 ?>