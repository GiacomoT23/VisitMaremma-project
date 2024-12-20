<?php
	function showError(){
		echo '<div class="error"><span>Sorry but something went wrong. Please try later!</span></div>';
	} 
	
	function showWarning($message){
		echo '<div class="warning"><span>' . $message . '</span></div>';
	}	
?>