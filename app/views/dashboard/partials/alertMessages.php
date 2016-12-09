<?php
	if(isset($_SESSION['messages'])){
		if(is_array($_SESSION['messages'])){
			foreach ($_SESSION['messages'] as $message) {
				echo '<div class="active-message">' . $message . '</div>';
			}
		} else {
			echo '<div class="active-message">' . $_SESSION['messages'] . '</div>';
		}
	}
?>
