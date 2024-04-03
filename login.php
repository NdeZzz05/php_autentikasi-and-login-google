<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require "function.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($login) === 1) {
        // Cek Password
        $row = mysqli_fetch_assoc($login);
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['fullname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['logged_in'] = true;
            header('Location: index.php');
            exit;
        } else {
            echo "<script>
                    alert('email dan password salah');
                </script>";
        }
    }
}

if (isset($_SESSION['logged_in'])) {
    header('Location: index.php');
}

// Koneksi Database
$conn = mysqli_connect("localhost", "root", "", "db_login_google") or die("Koneksi Gagal Terhubung");

// Panggil Library
require_once "vendor/autoload.php";

// Tampung client ID, client secret, redirect URI
$client_id = "1034598498902-ahhf0ffaa5ktnnuco4pv6ksjctuipfjm.apps.googleusercontent.com";
$client_secret = "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";
$redirect_uri = "http://localhost/uts-webservice/login.php";

// Inisialisasi Google Client
$client = new Google_Client();

// Konfigurasi Google Client
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);

$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {

        $client->setAccessToken($token['access_token']);

        // inisiasi google service oauth2
        $service = new Google_Service_Oauth2($client);
        $profile = $service->userinfo->get();

        // tampung data respon dari google
        $g_name = $profile['name'];
        $g_email = $profile['email'];
        $g_id = $profile['id'];

        $currtime = date("Y-m-d H:i:s");

        // Kondisi jika id sudah ada di table users, maka lakukan update data saja
        // Jika id belum ada, lakukan insert data

        $query_check = "SELECT * FROM users WHERE oauth_id = '$g_id'";
        $run_query_check = mysqli_query($conn, $query_check);
        $d = mysqli_fetch_object($run_query_check);

        if ($d) {

            $query_update = "UPDATE users SET fullname = '$g_name', email = '$g_email', last_login = '$currtime' WHERE oauth_id = '$g_id'";
            $run_query_update = mysqli_query($conn, $query_update);
        } else {
            $query_insert = "INSERT INTO users (fullname, email, oauth_id, last_login) VALUES ('$g_name', '$g_email', '$g_id', '$currtime')";
            $run_query_insert = mysqli_query($conn, $query_insert);
        }

        // Daftarin session
        $_SESSION['logged_in'] = true;
        $_SESSION['access_token'] = $token['access_token'];
        $_SESSION['name'] = $g_name;

        header('Location: index.php');
    } else {
        echo "Login Gagal Brow";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .login {
            display: flex;
            justify-content: center;
            align-items: center;
            justify-items: center;
            height: 100vh;
            background-image: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);
        }

        .form-login {
            border-radius: 10px;
            padding: 40px;
            background-color: white;
            box-shadow: 20px 20px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .form-control::placeholder {
            opacity: 0.3 !important;
        }

        @media (max-width: 1024px) {
            .form-login {
                width: 40% !important;
            }
        }

        @media (max-width: 768px) {
            .form-login {
                width: 60% !important;
            }
        }

        @media (min-width: 320px) and (max-width: 426px) {
            .form-login {
                width: 95% !important;
            }
        }
    </style>
</head>

<body>
    <div class="login">
        <div class="form-login w-25">
            <form action="" method="post">
                <h5 class="mb-3 font-weight-normal d-flex justify-content-center fw-bold">Login</h5>
                <div class="mb-3">
                    <label for="email" class="form-label fs-6 fw-normal">Email address</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="21106312550055@student.unsika.ac.id" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fs-6 fw-normal">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="********">
                </div>
                <button type="submit" name="login" class="btn w-100 btn-primary">Login</button>
            </form>
            <div class="d-flex justify-content-center gap-1 mt-3">
                <p>Don't have an account? </p>
                <a href="register.php" class="text-decoration-none">register</a>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <a href="<?= $client->createAuthUrl(); ?>">
                    <img src="assets/img/btn-google-neutral.png" alt="button google" />
                </a>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>