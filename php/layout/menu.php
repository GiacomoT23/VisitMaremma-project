<?php
	require_once DIR_UTIL . "sessionUtil.php";
?>

<div class="div_utente">
		<?php
			displayNome();
		?>
</div>
	<ul id = "menu">
		<li><a href="home.php" id="home_link" class="unselected_link">Home</a></li>
		<li><a href="profilo.php" id="profilo_link" class="unselected_link">Profilo</a></li>
		<li><a href="luoghi.php" id="luoghi_link" class="unselected_link">Luoghi</a></li>
		<li><a href="cerca.php" id="cerca_link" class="unselected_link">Cerca</a></li>
	</ul>
