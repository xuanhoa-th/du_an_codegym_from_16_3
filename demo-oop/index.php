<?php
include "class/Student.php";
include "class/StudentManager.php";

$studentManager = new StudentManager("data/data.json");
$students = $studentManager->getStudents();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quan ly sinh vien</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="mai1">
    <h1>Danh sách sinh viên</h1>
    <hr>
</div>
<div class="col-md-5">
        <form class="navbar-form navbar-left" role="search" method="post" action="action/store.php">
           <h3><b>Thêm mới Sinh Viên</b></h3>
           <br>
           <span style="font-size: 16px">Họ và tên SV:</span>
           <input type="text" class="form-control" name="name" >
           <br>
           <br>
           <span style="font-size: 16px">Địa chỉ Email:</span>
           <input type="text" class="form-control" name="email" >
           <br>
           <br>
           <span style="font-size: 16px">Số điện thoại:</span>
           <input type="text" class="form-control" name="phone" >
           <br>
           <br>
           <button type="submit" class="btn btn-success">Thêm Sinh Viên</button>
           
        </form>
    </div>
<div class="col-md-7">
    <form class="navbar-form navbar-left" role="search" method="post" action="view/seach.php">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" value="" name="keyword">
        </div>
        <a href=""><button class="btn btn-success">Tìm kiếm</button></a>
    </form>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>STT</th>
            <th>Họ và tên</th>
            <th>Địa chỉ Email</th>
            <th>Số điện thoại</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php if(isset($students)): ?>
            <?php foreach ($students as $index => $student):?>
                <tr>
                    <td> <?php echo $index +1 ?> </td>
                    <td> <?php echo $student -> getName() ?> </td>
                    <td> <?php echo $student-> getemail() ?> </td>
                    <td> <?php echo $student-> getphone() ?> </td>
                    <td><a href="view/edit.php?index=<?php echo $index ?>"><button class="btn btn-success">Sửa</button></a></td>
                    <td><a onclick = "return confirm('ban chac muon xoa') " href="action/delete.php?index=<?php echo $index ?>"><button class="btn btn-danger">Xóa</button></a></td>
                </tr>
            <?php endforeach ?>
        <?php else: ?>
            <tr>
                <td>No data</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
