<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .index {
            display: flex;
            justify-content: center;
            align-items: center;
            justify-items: center;
            height: 100vh;
            background-image: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);
        }
    </style>
</head>

<body>
    <div class="index">
        <div class="container">
            <div class="text-center d-flex flex-column align-items-center gap-3">
                <h1 class="fw-bold">Welcome!</h1>
                <h6>Hai, <?php echo $_SESSION['name']; ?></h6>
                <a href="logout.php" type="button" class="btn btn-danger px-5">Logout</a>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>