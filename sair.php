<?php
session_start();
session_destroy();
header("Location:.\quizvest.php");
die();