<?php
/**
 * Created by PhpStorm.
 * User: Arszorin
 * Date: 28.03.2018
 * Time: 22:33
 */
session_start();
session_regenerate_id();
session_destroy();
header("Location: index.php");