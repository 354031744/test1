<?php
header("Content-type: text/html; charset=utf-8");
include('./payApi.php');

$lemon = new LemonApi();
echo $lemon->query();
