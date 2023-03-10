<?php
function redirect($new_loc) {
	header("Location:".$new_loc);
	exit;
}
