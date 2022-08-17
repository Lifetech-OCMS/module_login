<?php
session_start();
session_destroy();
echo '<script>alert("You have Successfully Logout");</script>';
echo '<script>window.location="index.php";</script>';


?>