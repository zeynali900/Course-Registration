<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
	<meta charset="utf-8">
    <title>ثبت نام ها</title>
    <style>
        table, th, td {
            border: 1px solid #111;
            border-collapse:collapse;
        }
        th, td {
            padding: 10px;
            text-align:center;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
    $connect = new mysqli("localhost", "root", "", "coursereg");
    $connect->set_charset("utf8mb4");
    if($connect->connect_error){
        die("connection failed: ".$connect->connect_error);
    }
    $sql = "select * from `regdata`";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        echo "<table><tr><th>شناسه</th><th>نام و نام خانوادگی</th><th>شماره تماس</th><th>سال ورود</th><th>رشته</th><th>دوره PHP</th><th>دوره JS</th><th>دوره Network</th><th>دوره MCSA</th><th>جمعه‌ها می‌تونم بیام</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>"."<td>".$row["id"]."</td>". 
            "<td>".$row["fullname"]."</td>".
            "<td>".$row["phonenum"]."</td>".
            "<td>".$row["vorudi"]."</td>".
            "<td>".$row["major"]."</td>";
            if($row["php"]==1){
                echo '<td><i class="fa fa-check-circle"></i></td>';
            }
            else{
                echo "<td></td>";
            }
            if($row["js"]==1){
                echo '<td><i class="fa fa-check-circle"></i></td>';
            }
            else{
                echo "<td></td>";
            }
            if($row["net"]==1){
                echo '<td><i class="fa fa-check-circle"></i></td>';
            }
            else{
                echo "<td></td>";
            }
            if($row["mcsa"]==1){
                echo '<td><i class="fa fa-check-circle"></i></td>';
            }
            else{
                echo "<td></td>";
            }
            if($row["fridays"]==1){
                echo '<td><i class="fa fa-check-circle"></i></td>';
            }
            else{
                echo "<td></td>";
            }
			echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "هیچ نتیجه‌ای یافت نشد.";
    }
    $connect->close();
?>
    <br>
    <button><a href="index.php">ثبت نام جدید</a></button>
    <button><a href="delete.php">حذف ثبت نام</a></button>
	<button><a href="edit2.php">ویرایش ثبت نام</a></button>
</body>
</html>