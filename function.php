<?php

$conn = mysqli_connect("localhost", "root", "", "db_login_google") or die("Koneksi Gagal Terhubung");

function registrasi($data)
{
    global $conn;

    $fullname = strtolower(stripslashes($data["fullname"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek fullname sudah ada atau belum
    $result = mysqli_query($conn, "SELECT fullname FROM users WHERE fullname = '$fullname'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('fullname sudah terdaftar!');
                </script>";
        return false;
    }

    // cek email sudah ada atau belum
    $result = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('email sudah terdaftar!');
                </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
                </script>";
        return false;
    }

    // Enskripsi Passwaord
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')");

    return mysqli_affected_rows($conn);
}
