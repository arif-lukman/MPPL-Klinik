<?php
	foreach ($_POST as $key => $value)
 		echo "Field with name or id ".htmlspecialchars($key)." has a value equals ".htmlspecialchars($value)."<br>";
?>