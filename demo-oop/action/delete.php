<?php

include "../class/Student.php";
include "../class/StudentManager.php";

$index = $_REQUEST['index'];
$studentManager = new StudentManager("../data/data.json");
$studentManager->deleteStudent($index);
header("Location: ../index.php");
