<?php
	echo '<nav class="page_navigation">';
	echo '<input type="button" value=" " class="previous" disabled ';
	echo 'onClick="PlaceLoader.previous(' . $searchType . ', ' . $admin . ', ' . $logged . ')">'; 
	echo '<div class="currentPage">1</div>';
	echo '<input type="button" value=" " class="next" disabled ';
	echo 'onClick="PlaceLoader.next(' . $searchType . ', ' . $admin . ', ' . $logged . ')">';
	echo '</nav>';
?>