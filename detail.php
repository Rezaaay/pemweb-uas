<?php
require 'fungsi.php';
require 'cek.php';

//dapetin id barang yang dipassing di halaman sebelumnya
$idbarang = $_GET['id'];//untuk get id barang
//Get informasi detail barang berdasarkan database
$get = mysqli_query($conn,"SELECT * FROM stock where idbarang='$idbarang'");
$fetch = mysqli_fetch_array($get);
//set variable
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];

//cek apakah ada gambar atau tidak
$gambar = $fetch['image']; //ambil gambar
if($gambar==null){
    //jika tidak ada gambar
    $img = 'No Photo';
} else{
    //jika ada gambar
    $img = '<img src="images/'.$gambar.'" class="zoomable">';
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stock Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/style2.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <style>
            .zoomable{
                width: 150px;
            }
            .zoomable:hover{
                transform: scale(1.5);
                transition: 0.3s ease;
            }

            a{
                text-decoration:none;
                color:black;
            }
        </style>

    </head>
    <body class="sb-nav-fixed">
        <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bxs-badge-dollar'></i>
      <span class="logo_name">ShopagE</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="index.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Stock Barang</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="index.php">Stock Barang</a></li>
        </ul>
      <li>
        <a href="masuk.php">
          <i class='bx bx-log-in-circle' ></i>
          <span class="link_name">Barang Masuk</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="masuk.php">Barang Masuk</a></li>
        </ul>
      </li>
      <li>
        <a href="keluar.php">
          <i class='bx bx-log-out-circle' ></i>
          <span class="link_name">Barang Keluar</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="keluar.php">Barang Keluar</a></li>
        </ul>
      </li>
      <li>
        <a href="peminjaman.php">
          <i class='bx bx-transfer' ></i>
          <span class="link_name">Peminjaman</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="peminjaman.php">Peminjaman</a></li>
        </ul>
      </li>
      <li>
        <a href="admin.php">
          <i class='bx bx-user'></i>
          <span class="link_name">Admin</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="admin.php">Admin</a></li>
        </ul>
      </li>
      <li>
        <a href="logout.php">
          <i class='bx bx-log-out' ></i>
          <span class="link_name">Log Out</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="logout.php">Log Out</a></li>
        </ul>
      </li>
      <li>
    <div class="profile-details">
      <div class="profile-content">
        <img src="css/profile.jpg" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name">john cooper</div>
        <div class="job">Admin</div>
      </div>
      <i></i>
    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <h1 class="mt-4">Detail Barang</h1>
    </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"></h1>
                        
                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                               <h2> <?=$namabarang;?> </h2>
                                <?=$img;?> 
                            </div>
                            <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">Deskripsi</div>
                                <div class="col-md-9">: <?=$deskripsi;?> </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">Stock</div>
                                <div class="col-md-9">: <?=$stock;?> </div>
                            </div>

                            <br><br><hr>

                            
                                <h3> Barang Masuk</h3>
                                <div class="table-responsive">
                                <table class="table table-bordered" id="barangmasuk" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambildatamasuk = mysqli_query($conn,"SELECT * FROM masuk where idbarang='$idbarang'");
                                        $i = 1;

                                        while($fetch=mysqli_fetch_array($ambildatamasuk)){
                                            $tanggal = $fetch['tanggal'];
                                            $keterangan = $fetch['keterangan'];
                                            $quantity = $fetch['qty'];


                                        ?>


                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$keterangan;?></td>
                                            <td><?=$quantity;?></td>
                                        </tr>


                                        <?php
                                        };

                                        ?>

                                    </tbody>
                                </table>
                            </div>

                            <br><br>

                            <h3> Barang Keluar</h3>
                                <div class="table-responsive">
                                <table class="table table-bordered" id="barangkeluar" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Penerima</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $ambildatakeluar = mysqli_query($conn,"SELECT * FROM keluar where idbarang='$idbarang'");
                                        $i = 1;

                                        while($fetch=mysqli_fetch_array($ambildatakeluar)){
                                            $tanggal = $fetch['tanggal'];
                                            $penerima = $fetch['penerima'];
                                            $quantity = $fetch['qty'];


                                        ?>


                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$penerima;?></td>
                                            <td><?=$quantity;?></td>
                                        </tr>


                                        <?php
                                        };

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        </section>
    </body>
    <script src="js/script.js"></script>
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
            <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
            <br>
            <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
            <br>
            <input type="number" name="stock" placeholder="Jumlah Barang" class="form-control" required>
            <br>
            <input type="file" name="file" class="form-control">
            <br>
            <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
            </div>
            </form>

            </div>
        </div>
</div>

    
</html>
