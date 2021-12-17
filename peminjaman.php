<?php
require 'fungsi.php';
require 'cek.php';

//get data
//mengambil data total
$get1 = mysqli_query($conn, "SELECT * FROM peminjaman");
$count1 = mysqli_num_rows($get1); //menghitung semua kolom tabel

//ambil data peminjaman yang status sedang dipinjam
$get2 = mysqli_query($conn, "SELECT * FROM peminjaman where status='Dipinjam'");
$count2 = mysqli_num_rows($get2); //menghitung semua kolom yang statusnya dipinjam

//ambil data peminjaman yang sudah dikembalikan
$get3 = mysqli_query($conn, "SELECT * FROM peminjaman where status='Kembali'");
$count3 = mysqli_num_rows($get3); //menghitung semua kolom yang statusnya kembali

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
      <h1 class="mt-4">Peminjaman Barang</h1>
    </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"></h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Pinjam Barang
                                </button>
                                <br>
                                <div class="row mt-3">
                                <div class="col">
                                    <div class="card bg-dark text-white p-1">
                                      <h4><center>Total Data: <?=$count1;?></center></h4>
                                    </div>
                                </div>
                                <div class="col">
                                  <div class="card bg-danger text-white p-1"><h3><center>Total Dipinjam: <?=$count2;?></center></h3></div>
                                </div>
                                <div class="col">
                                    <div class="card bg-success text-white p-1"><h3><center>Total Dikembalikan: <?=$count3;?></center></h3></div>
                                </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                         <form method="post" class="form-inline">
                                            <input type="date" name="tgl_mulai" class="form-control">
                                            <input type="date" name="tgl_selesai" class="form-control mt-3">
                                            <button type="submit" name="filter_tgl" class="btn btn-info mt-3">Filter</button>
                                    </form>
                                    </div>
                            </div>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Penerima</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                        if(isset($_POST['filter_tgl'])){
                                            $mulai = $_POST['tgl_mulai'];
                                            $selesai = $_POST['tgl_selesai'];

                                            if($mulai!=null || $selesai!=null){

                                            $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM peminjaman p, stock s where s.idbarang = p.idbarang 
                                            and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai', INTERVAL 1 DAY) order by idpeminjaman DESC");
                                        } else {
                                            $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM peminjaman p, stock s where s.idbarang = p.idbarang order by idpeminjaman DESC");
                                        }
                                            
                                        } else {
                                            $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM peminjaman p, stock s where s.idbarang = p.idbarang order by idpeminjaman DESC");
                                        }

                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idk = $data['idpeminjaman'];
                                            $idb = $data['idbarang'];
                                            $tanggal = $data['tanggalpinjam'];
                                            $namabarang = $data['namabarang'];
                                            $penerima = $data['peminjam'];
                                            $qty = $data['qty'];
                                            $status = $data['status'];

                                            //cek apakah ada gambar atau tidak
                                            $gambar = $data['image']; //ambil gambar
                                            if($gambar==null){
                                                //jika tidak ada gambar
                                                $img = 'No Photo';
                                            } else{
                                                //jika ada gambar
                                                $img = '<img src="images/'.$gambar.'" class="zoomable">';
                                            }
                                            
                                        ?>
                                        <tr>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$img;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$penerima;?></td>
                                            <td><?=$qty;?></td>
                                            <td><?=$status;?></td>
                                            <td>

                                            <?php 
                                                //cek status
                                                if($status=='Dipinjam'){
                                                    echo '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit'.$idk.'">
                                                    Selesai
                                                    </button>';
                                                } else {
                                                    //jika statusnya bukan dipinjam (sudah kembali)
                                                }
                                                
                                            ?>
                                            </td>           
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?=$idk;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Selesaikan</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">
                                            Apakah Barang sudah selesai dipinjam?
                                            <br> 
                                            <input type="hidden" name="idpinjam" value="<?=$idk;?>">
                                            <input type="hidden" name="idbarang" value="<?=$idb;?>">
                                            <br>
                                            <button type="submit" class="btn btn-primary" name="barangkembali">Ya</button>
                                            </div>
                                            </form>

                                            </div>
                                            </div>
                                        </div>

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
                <h4 class="modal-title">Tambah Barang Peminjaman</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <form method="post">
            <div class="modal-body">
            <select name="barangnya" class="form-control">
                <?php
                    $ambilsemuadatanya = mysqli_query($conn, "SELECT * FROM stock");
                    while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                        $namabarangnya = $fetcharray['namabarang'];
                        $idbarangnya = $fetcharray['idbarang'];
                ?>

                <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

                <?php
                    }
                
                ?>
            </select>
            <br>
            <input type="number" name="qty" placeholder="Jumlah Barang" class="form-control" required>
            <br>
            <input type="text" name="penerima" placeholder="Kepada" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary" name="pinjam">Submit</button>
            </div>
            </form>

            </div>
        </div>
</div>
</html>
