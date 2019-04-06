<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
	<meta charset="utf-8">
	<title>ثبت نام دوره‌ها</title>
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
			text-align:center;
        }
    </style>
</head>
<?php
    header('Content-type:text/html; charset=utf-8');
    $fullname = $phonenum = $vorudi = $major = $success = "";
    $php = $js = $net = $mcsa = $fridays = 0;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $fullname = htmlspecialchars($_POST["fullname"]);
        $phonenum = htmlspecialchars($_POST["phonenum"]);
        $vorudi = htmlspecialchars($_POST["vorudi"]);
        $major = htmlspecialchars($_POST["major"]);
        if(isset($_POST["php"])){$php = $_POST["php"];}
        if(isset($_POST["js"])){$js = $_POST["js"];}
        if(isset($_POST["net"])){$net = $_POST["net"];}
        if(isset($_POST["mcsa"])){$mcsa = $_POST["mcsa"];}
        if(isset($_POST["fridays"])){$fridays = $_POST["fridays"];}
        $connect = new mysqli("localhost", "root", "", "coursereg");
        if($connect->connect_error){
            die("connection failed: ".$connect->connect_error);
        }
		$connect->set_charset("utf8mb4");
        $sql = "INSERT INTO regdata (fullname, phonenum, vorudi, major, php, js, net, mcsa, fridays) VALUES ('$fullname', '$phonenum', '$vorudi', '$major', '$php', '$js', '$net', '$mcsa', '$fridays')";
        if($connect->query($sql) == "TRUE"){
            $success = "اطلاعات با موفقیت ثبت شد.";
        }else if($connect->error){
            $success = "Error: " . $connect->error;
        }
        $connect->close();
    }
?>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" accept-charset="utf-8">
        <p><input type="text" name="fullname" value="<?php echo $fullname; ?>" placeholder="نام و نام خانوادگی" required></p>
        <p><input type="number" name="phonenum" value="<?php echo $phonenum; ?>" placeholder="شماره موبایل" required></p>
        <p><input type="number" name="vorudi" value="<?php echo $vorudi; ?>" placeholder="ورودی سال" required></p>
        <p>
        <select name="major" required size="6">
            <option value="مهندسی کامپیوتر - نرم‌افزار" <?php if($major=="مهندسی کامپیوتر - نرم‌افزار"){echo "selected";} ?>>مهندسی کامپیوتر - نرم‌افزار</option>
            <option value="مهندسی کامپیوتر - سخت‌افزار" <?php if($major=="مهندسی کامپیوتر - سخت‌افزار"){echo "selected";} ?>>مهندسی کامپیوتر - سخت‌افزار</option>
            <option value="مهندسی فناوری اطلاعات" <?php if($major=="مهندسی فناوری اطلاعات"){echo "selected";} ?>>مهندسی فناوری اطلاعات</option>
            <option value="مهندسی برق" <?php if($major=="مهندسی برق"){echo "selected";} ?>>مهندسی برق</option>
            <option value="مهندسی رباتیک" <?php if($major=="مهندسی رباتیک"){echo "selected";} ?>>مهندسی رباتیک</option>
            <option value="مهندسی شیمی" <?php if($major=="مهندسی شیمی"){echo "selected";} ?>>مهندسی شیمی</option>
        </select>
		</p>
        دوره‌ها:
		<p dir="ltr">
        <input type="checkbox" name="php" value="1" <?php if($php == "1"){echo "checked";} ?>><span>PHP&nbsp;&nbsp;&nbsp;</span>
        <input type="checkbox" name="js" value="1" <?php if($js == "1"){echo "checked";} ?>><span>JS&nbsp;&nbsp;&nbsp;</span>
        <input type="checkbox" name="net" value="1" <?php if($net == "1"){echo "checked";} ?>><span>Network+&nbsp;&nbsp;&nbsp;</span>
        <input type="checkbox" name="mcsa" value="1" <?php if($mcsa == "1"){echo "checked";} ?>><span>MCSA&nbsp;&nbsp;&nbsp;</span>
		</p>
        <p>
        می‌تونم جمعه‌ها بیام <input type="checkbox" name="fridays" value="1" <?php if($fridays=="1"){echo "checked";} ?>>
		</p><br>
        <input type="submit" name="submit" value="ثبت">
        <button><a href="read.php">مشاهده‌ی ثبت نام ها</a></button>
        <button><a href="delete.php">حذف ثبت نام</a></button>
        <button><a href="edit2.php">ویرایش ثبت نام</a></button>
        <?php echo $success; ?>
	</form>
</body>
</html>