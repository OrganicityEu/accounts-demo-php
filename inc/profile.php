<?php

if(!isset($_SESSION['username'])) {
	echo '<div class="alert alert-danger"><b>401 Unauthorized</b> You\'re not logged in!</div>';
} else {
	echo '<h3>Profile</h3>';
	echo '<ul>';
	echo '  <li>Username: ' . $_SESSION['username'] . '</li>';
	echo '  <li>Email: ' . $_SESSION['email'] . '</li>';
	echo '  <li>Roles: ' . implode(", ", $_SESSION['roles']) . '</li>';
	echo '</ul>';
}

?>
