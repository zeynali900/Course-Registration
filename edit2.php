<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
	<meta charset="utf-8">
    <title>ویرایش ثبت نام</title>
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
        #form2{
            display:none;
            text-align:center;
        }
    </style>
    <script>
        function f1(){
            document.getElementById("form1").style.display = "none";
            document.getElementById("form2").style.display = "inline-block";
        }
    </script>
</head>
<?php
    $regid = $fullname = $phonenum = $vorudi = $major = $found = $notfound = $success = "";
    $php = $js = $net = $mcsa = $fridays = 0;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["mobnum"])){
            $mobnum = $_POST["mobnum"];
            $conn = new mysqli("localhost","root","","coursereg");
            if($conn->connect_error){
                die("connection failed: ".$conn->connect_error);
            }
            $conn->set_charset("utf8mb4");
            $sql ="SELECT * FROM regdata WHERE phonenum = '$mobnum';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $found = "<script>f1();</script>";
                $row = $result->fetch_assoc();
                $regid = $row["id"];
                $fullname = $row["fullname"];
                $phonenum = $row["phonenum"];
                $vorudi = $row["vorudi"];
                $major = $row["major"];
                $php = $row["php"];
                $js = $row["js"];
                $net = $row["net"];
                $mcsa = $row["mcsa"];
                $fridays = $row["fridays"];
            }else{
                $notfound = "ثبت نامی با این شماره موبایل وجود ندارد.";
            }
            $conn->close();
        }
        if(isset($_POST["fullname"])){
            $found = "<script>f1();</script>";
            $fullname = $_POST["fullname"];
            $phonenum = $_POST["phonenum"];
            $vorudi = $_POST["vorudi"];
            $major = $_POST["major"];
            $regid = $_POST["regid"];
            if(isset($_POST["php"])){
                $php = 1;
            }else{$php = 0;}
            if(isset($_POST["js"])){
                $js = 1;
            }else{$js = 0;}
            if(isset($_POST["net"])){
                $net = 1;
            }else{$net = 0;}
            if(isset($_POST["mcsa"])){
                $mcsa = 1;
            }else{$mcsa = 0;}
            if(isset($_POST["fridays"])){
                $fridays = 1;
            }else{$fridays = 0;}
            $conn = new mysqli("localhost","root","","coursereg");
            if($conn->connect_error){
                die("connection failed: ".$conn->connect_error);
            }
            $conn->set_charset("utf8mb4");
            $sql = "UPDATE regdata SET fullname = '$fullname', phonenum = '$phonenum', vorudi = '$vorudi',
                    major = '$major', php = '$php', `js` = '$js', `net` = '$net', mcsa = '$mcsa', fridays = '$fridays' WHERE `id`='$regid';";
            if($conn->query($sql) == "TRUE"){
                $success = "ویرایش اطلاعات با موفقیت انجام شد.";
            }else if($conn->error){
                $success = "Error: " . $conn->error;
            }
            $conn->close();
        }
    }
?>
<body>
    <h1>ویرایش ثبت نام</h1>
    <form id="form1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="number" name="mobnum" placeholder="شماره موبایل خود را وارد کنید" required><br><br>
        <input type="submit" name="submit" value="تأیید">
        <?php echo $notfound; ?>
    </form>
    <form id="form2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p><input type="text" name="fullname" value="<?php echo $fullname; ?>" placeholder="نام و نام خانوادگی" required></p>
        <p><input type="number" name="phonenum" value="<?php echo $phonenum; ?>" placeholder="شماره موبایل" required></p>
        <p><input type="number" name="vorudi" value="<?php echo $vorudi; ?>" placeholder="ورودی سال" required></p>
        <input type="hidden" name="regid" value="<?php echo $regid; ?>">
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
		</p>
        <p><input type="submit" name="submit" value="تأیید" style="width:45px; height:30px;"></p>
        <?php echo $success; ?><br>
        <button><a href="read.php">مشاهده‌ی ثبت نام ها</a></button>
        <button><a href="delete.php">حذف ثبت نام</a></button>
	</form>
    <?php echo $found; ?>
</body>
</html>