<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
	<meta charset="utf-8">
	<title>حذف ثبت نام</title>
    <style>
        body{
            display:grid;
            grid-template-columns:auto auto auto;
        }
        form{
            grid-column-start:2;
            grid-column-end:3;
            border:2px solid blue;
            border-radius:5px;
            display:inline-block;
            padding:10px;
        }
    </style>
</head>
<?php
    header('Content-type:text/html; charset=utf-8');
    $phone = $success = "";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $phone = htmlspecialchars($_POST["phone"]);
        $connect = new mysqli("localhost", "root", "", "coursereg");
        $connect->set_charset("utf8mb4");
        if($connect->connect_error){
            die("connection to database failed: ".$connect->connect_error);
        }
        $sql = "SELECT fullname FROM regdata WHERE phonenum = $phone";
        $result = $connect->query($sql);
        if(mysqli_num_rows($result) == 0){
            $success = "ثبت نامی با این شماره موبایل پیدا نشد.";
        }else{
            $sql = "DELETE FROM `regdata` where phonenum = $phone";
            if($connect->query($sql) == "TRUE"){
                $success = "ثبت نام شما حذف شد.";
            }else if($connect->error){
                $success = "Error: " . $connect->error;
            }
        }
        $connect->close();
    }
?>
<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="number" name="phone" placeholder="شماره موبایل خود را وارد کنید" required><br><br>
        <input type="submit" name="submit" value="حذف ثبت نام">
        <button><a href="read.php">مشاهده‌ی ثبت نام ها</a></button>
        <button><a href="index.php">ثبت نام جدید</a></button>
        <?php echo $success; ?>
    </form>
</body>
</html>