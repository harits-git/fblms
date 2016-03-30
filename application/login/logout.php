<?php

/**
 * @author Rel Sepoer Foundation
 * @copyright 2009
 */

session_start();
unset($_SESSION["username"]);
unset($_SESSION["namadosen"]);

header("location:index.php");

?>