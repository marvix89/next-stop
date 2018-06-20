<?php

include 'funzioni.php';


$data = new MysqlClass();
$data->connetti();



  
$SqlString = "select * from compagnie";
$post_sql = $data->query($SqlString);

if (mysql_num_rows($post_sql) > 0) {
    while ($post_obj = $data->estrai($post_sql)) {

  ?>
  <option value="<?=$post_obj->id?>">
  <?=$post_obj->nome?>
  </option>
  
  <?php
	}
}

$data->disconnetti();

 ?>