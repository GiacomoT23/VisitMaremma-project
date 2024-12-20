<?php
	echo '<nav class="page_navigation">';
	echo '<input type="button" value=" " class="previous" disabled ';
	echo 'onClick="UserLoader.previous(' . $searchType . ')">'; 
	echo '<div class="currentPage">1</div>';
	echo '<input type="button" value=" " class="next" disabled ';
	echo 'onClick="UserLoader.next(' . $searchType . ')">';
	echo '</nav>';
?>