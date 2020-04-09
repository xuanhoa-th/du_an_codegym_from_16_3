<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "../class/Student.php";
    include "../class/StudentManager.php";
    if ($_REQUEST['name'] != null && $_REQUEST['email'] != null && $_REQUEST['phone'] ){
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];
        $student = new Student($name, $email, $phone);
        $studentManager = new StudentManager("../data/data.json");
        $studentManager->add($student);
        header("Location: ../index.php");
    } else {
        echo "khong duoc de rong";
    }

}