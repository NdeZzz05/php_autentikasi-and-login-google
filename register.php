<?php
require 'function.php';

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
            alert('user baru berhasil ditambahkan, klik ok menuju login');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>

    <!-- <link rel="stylesheet" href="css/register.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .register {
            display: flex;
            justify-content: center;
            align-items: center;
            justify-items: center;
            height: 100vh;
            background-image: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);
        }

        .form-register {
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
            .form-register {
                width: 40% !important;
            }
        }

        @media (max-width: 768px) {
            .form-register {
                width: 60% !important;
            }
        }

        @media (min-width: 320px) and (max-width: 426px) {
            .form-register {
                width: 95% !important;
            }
        }
    </style>
</head>

<body>
    <div class="register">
        <div class="form-register w-25">
            <form action="" method="post">
                <h5 class="mb-3 font-weight-normal d-flex justify-content-center fw-bold">Registrasi</h5>
                <div class="mb-3">
                    <label for="fullname" class="form-label fs-6 fw-normal">Fullname</label>
                    <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Muhammad Fernandes" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fs-6 fw-normal">Email address</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="21106312550055@student.unsika.ac.id" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fs-6 fw-normal">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="********">
                </div>
                <div class="mb-3">
                    <label for="password2" class="form-label fs-6 fw-normal">Konfirmasi Password</label>
                    <input type="password" name="password2" id="password2" class="form-control" placeholder="********">
                </div>
                <button type="submit" name="register" class="btn w-100 btn-primary">Register</button>
            </form>
            <div class="d-flex justify-content-center gap-1 mt-3">
                <p>Already have an account? </p>
                <a href="login.php" class="text-decoration-none"> login</a>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>