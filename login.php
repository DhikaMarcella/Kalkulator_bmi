<?php
session_start();
$koneksi = mysqli_connect("sql213.byethost22.com", "b22_35055773", "bmi1234", "b22_35055773_BMI");



if (isset($_POST['login'])){
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM data_bmi WHERE username = '$username' && password = '$password'";

$result = mysqli_query($koneksi, $sql);



if (mysqli_num_rows($result) === 1) { 
    $_SESSION['username'] = $username;
	header('Location: BMI.php');
    exit;
} else {
    header('Location: index.html');
    exit;
}
}
?>