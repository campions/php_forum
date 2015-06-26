<?php
	$website=file_get_contents('http://www.vremea.net/Vremea-in-Bucuresti-judetul-Ilfov/prognoza-meteo-pe-7-zile/');
	$temp1=explode('<table class="tableforecast"',$website);
	$temp2=$temp1[1];
	$temp2='<table class="tableforecast"'.$temp2;
	$sfarsit=strpos($temp2, "<h1>");	
	$temp3=substr($temp2,0,$sfarsit);
	$temp3=$temp3.'</div>';
	echo '<div>';
	echo '<h2>Vremea in Bucuresti astazi</h2>';
	echo $temp3;
	echo '</div>';
	?>