<?php

require('resources/config.php');
session_start();
unset($_SESSION['login']);
header('Location: login.php');
