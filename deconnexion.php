<?php
session_start();

unset($_SESSION["membres"]);

header("Location:index.php");

?>