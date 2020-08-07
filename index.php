<?php
session_unset();
require_once 'ServerStuff/PageController.php';
$worker = new PageController();
$worker->pageWorker();
?>