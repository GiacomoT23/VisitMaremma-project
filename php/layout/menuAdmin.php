<?php
	require_once DIR_UTIL . "sessionUtil.php";
?>

<div class="div_utente">
		<?php
			echo 'Amministratore: ';
			displayNome();
		?>
</div>
	<ul id = "menu">
		<li><a href="luoghiAdmin.php" id="luoghi_link">Luoghi</a></li>
		<li><a href="utentiAdmin.php" id="utenti_link">Utenti</a></li>
		<li><a href="cercaAdmin.php" id="cerca_link">Cerca</a></li>
	</ul>