<?php
include "../class/Student.php";
include "../class/StudentManager.php";
$keyword = $_REQUEST['keyword'];

$studentManager = new StudentManager("../data/data.json");
$students = $studentManager->getKeyword($keyword);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quan ly sinh vien</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<div class="mai1">
    <h1>Danh sách sinh viên</h1>
    <hr>
</div>
<div class="container">
    <div class="col-md-12" id="search">
        <form class="navbar-form navbar-left" role="search" method="post" action="../view/seach.php">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" value="<?php echo $keyword ?>" name="keyword">
            </div>
                    <a href="">
                        <button class="btn btn-success">Tìm kiếm</button>
                    </a>
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
            <?php if (count($students) > 0): ?>
                <?php foreach ($students as $index => $student): ?>
                    <tr>
                        <td> <?php echo $index + 1 ?> </td>
                        <td> <?php echo $student->getName() ?> </td>
                        <td> <?php echo $student->getemail() ?> </td>
                        <td> <?php echo $student->getphone() ?> </td>
                        <td><a href="../view/edit.php?index=<?php echo $index ?>">
                                <button class="btn btn-success">Sửa</button>
                            </a></td>
                        <td><a onclick="return confirm('ban chac muon xoa') "
                               href="../action/delete.php?index=<?php echo $index ?>">
                                <button class="btn btn-danger">Xóa</button>
                            </a></td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">
                        <p class="text-center" style="color: red">No data</p>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

