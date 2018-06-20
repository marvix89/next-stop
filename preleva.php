<?php

include 'funzioni.php';

$data = new MysqlClass();
$data->connetti();

$compagnia=$_GET['compagnia'];
$linea=$_GET['linea'];
$timestamp=$_GET['timestamp'];


 echo '<div id="wrapper" style="overflow: hidden;">
		<ul id="busList"  data-role="listview" data-inset="true">';
		
$SqlString = "SELECT * from bus where compagnia='".$compagnia."' AND linea='".$linea."' ";
$post_sql = $data->query($SqlString);
if (mysql_num_rows($post_sql) > 0) {
    while ($post_obj = $data->estrai($post_sql)) {
      
	  ?>
	  <li>
			<a href="bus.php?id=<?=$post_obj->id?>" onclick="loadScript()" data-transition="slide">

			<img src="img/<?=$post_obj->face?>.png">			
			<h2><?=$post_obj->messaggio?></h2>
			<label><?=date("H:i:s", $post_obj->timestamp);?></label>
			 
            </a>
		  </li>
		  
	<?php
    }
}else{

echo "<li>Nessun Bus Trovato. inserisci la tua segnalazione.</li>";
echo  '<li>
			<a href="segnalazione.php" data-transition="slide">

			<input class="button" type="button" value="Nuova Segnalazione">
          
            </a>
		  </li>';

}
echo ' <ul>	</div>';
$data->disconnetti();

 ?>