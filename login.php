<?php
require 'fungsi.php';

    //untuk mengecek apakah user sudah terdaftar atau belum
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        //mencocokan data dengan database, apakah ada atau tidak datanya
        $cekdatabase=mysqli_query($conn, "SELECT * FROM login where email='$email' and password='$password'");
        //hitung jumlah data
        $hitung = mysqli_num_rows($cekdatabase);

        if ($hitung>0){
            $_SESSION['log'] = "True";
            header('location:index.php');
        } else {
            header('location:login.php');
        };
    };

    
if (!isset($_SESSION['log'])){

} else{
    header('location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="css/style1.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>

        <div class="card-body">
          <h4 class="title text-center mt-4">
            Login into account
          </h4>
          <form method="post" class="form-box px-3">
            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input class="form-control" name="email"id="inputEmail" type="email" placeholder="name@example.com" />
            </div>
            <div class="form-input">
              <span><i class="fa fa-key"></i></span>
              <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
            </div>

            <div class="mb-3">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="cb1" name="">
                <label class="custom-control-label" for="cb1">Remember me</label>
              </div>
            </div>

            <div class="mb-3">
              <button type="submit" class="btn btn-block text-uppercase" name="login">
                Login
              </button>
            </div>
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>