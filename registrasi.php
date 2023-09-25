
<?php
$koneksi = mysqli_connect("sql213.byethost22.com", "b22_35055773", "bmi1234", "b22_35055773_BMI");



if (isset($_POST['register'])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Cek apakah akun dengan email yang sama sudah terdaftar
    $check_query = "SELECT * FROM data_bmi WHERE email = '$email'";
    $check_result = mysqli_query($koneksi, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Akun sudah terdaftar, tampilkan pesan kesalahan
        header('Location: register.html');
        exit;
    }


    

    $query = "INSERT INTO data_bmi VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: index.html');
        exit;
    } else {
        header('Location: register.html');
        exit;
    }
}
?>