<?php
session_start();
require("dbconnect.php");
if (isset($_POST['username'])) {
  
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $sql = "SELECT * FROM employee where emp_user='" . $username . "' AND emp_pass='" . $password . "'";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $_SESSION["emp_id"] = $row["emp_id"];
    $_SESSION["emp_user"] = $row["emp_name"] . " " . $row["empp_username"];
    $_SESSION["emp_level"] = $row["emp_level"];
    if ($_SESSION["emp_level"] == "a") {
      header("location:admin_page.php");
    }
    if ($_SESSION["emp_level"] == "u") {
      header("location:user_page.php");
    }
  } else {
    echo "<script>";
    echo "alert(\"ชื่อเข้าระบบหรือรหัสผ่านไม่ถูกต้อง\");";
    echo "window.history.back()";
    echo "</script>";
  }
} else {
  header("location:login.php");
}
