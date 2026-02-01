<?php
if (!User::isLoggedIn()) {
    header("Location:./login.php");
    exit;
}
