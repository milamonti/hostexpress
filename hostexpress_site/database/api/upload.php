<?php

require_once '../config/config.php';
require_once MODULES . '/uploadManager.php';

Upload::uploadPhoto($_POST['id']);
?>