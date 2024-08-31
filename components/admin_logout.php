<?php

include 'connect.php';

setcookie('seller_id', '', time() - 1, '/');
header('location: ../admin panel/login.php');
