<?php
require 'fungsi.php';
require 'cek.php';
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
      <h1 class="mt-4">Barang Masuk</h1>
    </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"> </h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Tambah Barang Masuk
                                </button>
                                <br>
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
                                            <th>Dari</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                    if(isset($_POST['filter_tgl'])){
                                        $mulai = $_POST['tgl_mulai'];
                                        $selesai = $_POST['tgl_selesai'];

                                        if($mulai!=null || $selesai!=null){
                                    
                                        $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM masuk m, stock s where s.idbarang = m.idbarang 
                                        and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai', INTERVAL 1 DAY)");

                                    } else {
                                        $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM masuk m, stock s where s.idbarang = m.idbarang");
                                    }
                                        
                                    } else {
                                        $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM masuk m, stock s where s.idbarang = m.idbarang");
                                    }

                                        while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                            $idb = $data['idbarang'];
                                            $idm = $data['idmasuk'];
                                            $tanggal = $data['tanggal'];
                                            $namabarang = $data['namabarang'];
                                            $keterangan = $data['keterangan'];
                                            $qty = $data['qty'];

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
                                            <td><?=$keterangan;?></td>
                                            <td><?=$qty;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idm;?>">
                                                Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idm;?>">
                                                Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?=$idm;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Edit Barang</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">
                                            <input type="text" name="keterangan" value="<?=$keterangan;?>" placeholder="Dari" class="form-control" required>
                                            <br>
                                            <input type="number" name="qty" value="<?=$qty;?>" placeholder="Jumlah Barang" class="form-control" required>
                                            <br>
                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <input type="hidden" name="idm" value="<?=$idm;?>">
                                            <button type="submit" class="btn btn-primary" name="updatebarangmasuk">Submit</button>
                                            </div>
                                            </form>

                                            </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete<?=$idm;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Hapus barang?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus <?=$namabarang;?>?
                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                <input type="hidden" name="kty" value="<?=$qty;?>">
                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
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
                <h4 class="modal-title">Tambah Barang Masuk</h4>
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
            <input type="text" name="penerima" placeholder="Dari" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
            </div>
            </form>

            </div>
        </div>
</div>
</html>
