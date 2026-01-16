<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] === 'admin') {
        header("location:admin.php");
    } else {
        header("location:userlogin.php");
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST['user'];
    $password = $_POST['pass'];
    

    $stmt = $conn->prepare(
        "select username, password, role, foto
         from user 
         where username=?"
    );
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $hasil = $stmt->get_result();
    $user  = $hasil->fetch_assoc(); // ← PENTING

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role'];
        $_SESSION['foto']     = $user['foto'];

        if ($user['role'] === 'admin') {
            header("location:admin.php");
        } else {
            header("location:userlogin.php");
        }
        exit;

    } else {
        $error = "username atau password salah";
    }

    $stmt->close();
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang Di Halaman Login</title>
    <link rel="icon" href="img/iocn.jpg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <style>
        body {
            position: relative;
            min-height: 100vh;
            background:
            linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url("img/atago&takao.png");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        .login-result {
            padding: 10px 30px;
            border-radius: 50px;
            text-align: center;
            max-width: 350px;  
            margin: 20px auto; 
            box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
        }

        .success {
            background: #c8f5e0;
            color: #006b3c;
        }

        .error {
            background: #fff3c4;
            color: #a10000;
        }

        .title {
            font-weight: bold;
            margin-top: 10px;
}
        
      
    </style>
    </head>
  <body class="bg-danger-subtle">  
        <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
            <div class="card border-0 shadow rounded-5">
                <div class="card-body">
                <div class="text-center mb-3">
                    <i class="bi bi-person-circle h1 display-4"></i>
                    <p>Welcome, Login Dulu Yah</p>
                    <hr />
                </div>
                <form action="" method="post">
                    <input
                        type="text"
                        name="user"
                        class="form-control my-4 py-2 rounded-4"
                        placeholder="Username"
                    />
                    <input
                        type="password"
                        name="pass"
                        class="form-control my-4 py-2 rounded-4"
                        placeholder="Password"
                    />
                    <div class="text-center my-3 d-grid">
                    <button class="btn btn-danger rounded-4">Login</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        </div>
        <br>
        <div>
            <?php
            
            // pas belum login rek
            if ($_SERVER["REQUEST_METHOD"] != "POST") {
                echo "
                <div class='login-result success'>
                    <div>user : admin</div>
                    <div>pass : 123456</div>
                    <div> Login Sek </div>
                </div>
                ";
            } 

            //saatpas udah login
            else {
                $user = $_POST['user'];
                $pass = $_POST['pass'];

                if ($user == $username && $pass == $password) {
                    echo "
                    <div class='login-result success'>
                        <div>user : $user</div>
                        <div>pass : $pass</div>
                        <div class='title'>Username dan Password Benar</div>
                    </div>
                    ";
                } else {
                    echo "
                    <div class='login-result error'>
                        <div>user : $user</div>
                        <div>pass : $pass</div>
                        <div class='title'>Username dan Password Salah</div>
                    </div>
                    ";
                }
            }
            ?>
        </div>
     <br>
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-sm btn-outline-secondary">Home</a>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <!DOCTYPE html>
    <script src="java.js"></script>
  </body>
</html>

<?php

?>