<?php
require '../function.php';
require '../cek.php'
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Halaman Awal</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">UD. JAWA PRESS</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang
                            </a>
                            <a class="nav-link" href="satuan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Satuan
                            </a>
                            <a class="nav-link" href="sup.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Supplier
                            </a>
                            <a class="nav-link" href="barang_masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="barang_keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>
                            
                            <a class="nav-link" href="../logout.php">
                                Keluar
                            </a>

                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">DATA BARANG</h1>
                    
                        <div class="card mb-4">
                            <div class="card-header">
                             
                            
                            </div>
                            <div class="card-body">

                            <!-- Alert Button -->

                            <?php
                                $ambilstock = mysqli_query($conn, "select * from barang where total < 10 ");

                                while($fetch = mysqli_fetch_array($ambilstock)){
                                    $barang = $fetch['namabarang'];
                                

                            ?>

                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Himbauan!</strong> Jumlah Barang <?=$barang;?> Menipis.
                                </div>

                                <?php

                                }

                                ?>

                                <table class="table table-bordered" id="mauexport">
                                    <thead>
                                    <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Supplier</th>
                                            <th>Tindakan</th>

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambildatastock1 = mysqli_query($conn, "select barang .*, satuan.namasatuan, supplier.namasup FROM barang INNER JOIN satuan ON barang.idsatuan=satuan.idsatuan INNER JOIN supplier ON barang.idsup=supplier.idsup");
                                        $i = 1;
                                        while($data = mysqli_fetch_array($ambildatastock1)){
                                            $idbar = $data ['idbarang'];
                                            
                                            $namabarang = $data['namabarang'];
                                            $namasatuan = $data['namasatuan'];
                                            $namasup = $data['namasup'];
                                            $harga = $data['harga'];
                                            $total = $data['total'];
                                            

                                            

                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namabarang; ?></td>
                                            <td><?=$namasatuan; ?></td>
                                            <td><?=$harga; ?></td>
                                            <td><?=$total; ?></td>
                                            <td><?=$namasup; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idbar;?>">
                                                    Edit
                                                </button>
                                                
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idbar;?>">
                                                    Delete
                                                </button>
                                            </td>
                                            
                                            
                                            
                                        </tr>

                                        <!-- EDI The Modal -->
                                        <div class="modal fade" id="edit<?=$idbar;?>">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">EDIT BARANG</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method = "post">
                                        <div class="modal-body">
                                        <input type="text" name = "namabarang" value="<?=$namabarang;?>" class="form-control" required>
                                        <br>
                                        <input type="text" name = "harga" value="<?=$harga;?>" class="form-control" required>
                                        <br>
                                        <select name="satuannya" class = "form-control" required>
                                            <?php
                                                $ambildatasatuan = mysqli_query($conn, "select * from satuan");
                                                while($fetcharray = mysqli_fetch_array($ambildatasatuan)){
                                                    $namasatuannya = $fetcharray['namasatuan'];
                                                    $idsatuannya = $fetcharray['idsatuan'];
                                            ?>
                                            <option value="<?=$idsatuannya;?>"><?=$namasatuannya;?></option>

                                            <?php
                                                }

                                            ?>
                                        </select>
                                        <br>
                                        <select name="supnya" class = "form-control" required>
                                            <?php
                                                $ambildatasup = mysqli_query($conn, "select * from supplier");
                                                while($fetcharray = mysqli_fetch_array($ambildatasup)){
                                                    $namasupnya = $fetcharray['namasup'];
                                                    $idsupnya = $fetcharray['idsup'];
                                            ?>
                                            <option value="<?=$idsupnya;?>"><?=$namasupnya;?></option>

                                            <?php
                                                }

                                            ?>
                                        </select>
                                        <br>
                                        <input type="number" name = "total" value="<?=$total;?>" class="form-control" required>
                                        <br>
                                        
                                        
                                        <input type="hidden" name="idbarang" value="<?=$idbar;?>">
                                        
                                        
                                        <button type="submit" class="btn btn-primary" name = "editbarang">Ubah</button>
                                        </div>
                                        </form>
                                        
                                        
                                    </div>
                                    </div>
                                    </div>

                                          <!-- Delete The Modal -->
                                          <div class="modal fade" id="delete<?=$idbar;?>">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">DELETE</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method = "post">
                                        <div class="modal-body">
                                        LANJUT MENGHAPUS ?
                                        <input type="hidden" name="idbarang" value="<?=$idbar;?>">
                                        
                                        
                                        
                                        <br>
                                        <br>
                                        
                                        <button type="submit" class="btn btn-danger" name = "hapusbarang">Hapus</button>
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
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

    </body>
                                    
</html>
