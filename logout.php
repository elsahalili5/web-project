<?php
require_once "./classes/User.php";

User::logout();

header("Location: home.php");
exit;
