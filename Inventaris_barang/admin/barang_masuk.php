<?php
require '../function.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>BARANG MASUK</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
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
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Kelola User
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
                        <h1 class="mt-4">BARANG MASUK</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">LIST BARANG</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                             <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Keranjang Barang Masuk
                            </button>
                            <a href="export_bm.php" class="btn btn-info">Cetak Data</a>
                            <br>
                            <div class="row mt-4">
                            <div class="col">
                                <form method = "post" class="form-inline">
                                    <input type="date" name="tgl_mulai" class = "form-control">
                                    <input type="date" name="tgl_usai" class = "form-control">
                                    <button type="submit" name="filter_tgl" class="btn btn-info ml-3">Filter</button>
                            </div>
                            </div>
                            </div>
                            <div class="card-body">
                            <table class="table table-bordered" id="mauexport_bm" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                            <th>Tanggal Masuk</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Supplier</th>
                                            <th>Stock</th>
                                            <th>Keterangan</th>
                                            <th>Tindakan</th>

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_POST['filter_tgl'])){
                                            $mulai = $_POST['tgl_mulai'];
                                            $usai = $_POST['tgl_usai'];

                                            if($mulai!=null || $usai!=null){
                                                $ambildatastock1 = mysqli_query($conn, "select bar_masuk.*, barang.namabarang, satuan.namasatuan, supplier.namasup FROM bar_masuk INNER JOIN barang ON bar_masuk.idbarang=barang.idbarang
                                         INNER JOIN satuan ON bar_masuk.idsatuan=satuan.idsatuan INNER JOIN supplier ON bar_masuk.idsup=supplier.idsup and tgl BETWEEN '$mulai' and DATE_ADD('$usai',INTERVAL 1 DAY) order by idmasuk DESC");
                                            } else {
                                                $ambildatastock1 = mysqli_query($conn, "select bar_masuk.*, barang.namabarang, satuan.namasatuan, supplier.namasup FROM bar_masuk INNER JOIN barang ON bar_masuk.idbarang=barang.idbarang
                                         INNER JOIN satuan ON bar_masuk.idsatuan=satuan.idsatuan INNER JOIN supplier ON bar_masuk.idsup=supplier.idsup order by idmasuk DESC");
                                            }

                                        } else{
                                            $ambildatastock1 = mysqli_query($conn, "select bar_masuk.*, barang.namabarang, satuan.namasatuan, supplier.namasup FROM bar_masuk INNER JOIN barang ON bar_masuk.idbarang=barang.idbarang
                                            INNER JOIN satuan ON bar_masuk.idsatuan=satuan.idsatuan INNER JOIN supplier ON bar_masuk.idsup=supplier.idsup order by idmasuk DESC");
                                        }
                                        while($data = mysqli_fetch_array($ambildatastock1)){
                                            $idm = $data['idmasuk'];
                                            $idb = $data['idbarang'];
                                            $tgl = $data['tgl'];
                                            $namabarang = $data['namabarang'];
                                            $namasatuan = $data['namasatuan'];
                                            $namasup = $data['namasup'];
                                            $ket = $data['ket'];
                                            $stock = $data['stock'];
                                            

                                            

                                        ?>
                                        <tr>
                                            <td><?=$tgl;?></td>
                                            <td><?=$namabarang; ?></td>
                                            <td><?=$namasatuan; ?></td>
                                            <td><?=$namasup; ?></td>
                                            <td><?=$stock; ?></td>
                                            <td><?=$ket; ?></td>
                                            <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>">
                                                    Edit
                                                </button>
                                                
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>">
                                                    Delete
                                                </button>
                                            </td>
                         
                                        </tr>

                                        <!-- EDI The Modal -->
                                        <div class="modal fade" id="edit<?=$idb;?>">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">EDIT BARANG MASUK</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method = "post">
                                        <div class="modal-body">
                                        <input type="text" name = "ket" value="<?=$ket;?>" class="form-control" required>
                                        <br>
                                        <input type="number" name = "stock" value="<?=$stock;?>" class="form-control" required>
                                        <br>
                                        
                                        
                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                        <input type="hidden" name="idm" value="<?=$idm;?>">
                                        <button type="submit" class="btn btn-primary" name = "editmasuk">Ubah</button>
                                        </div>
                                        </form>
                                        
                                        
                                    </div>
                                    </div>
                                    </div>

                                          <!-- Delete The Modal -->
                                          <div class="modal fade" id="delete<?=$idb;?>">
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
                                        <input type="hidden" name="idb" value="<?=$idb;?>">
                                        <input type="hidden" name="idm" value="<?=$idm;?>">
                                        
                                        <br>
                                        <br>
                                        <input type="hidden" name="stock" value="<?=$stock;?>">
                                        <button type="submit" class="btn btn-danger" name = "hapusmasuk">Hapus</button>
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
                                    <!-- The Modal -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">Tambah Barang</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method="post">
                                        <div class="modal-body">
                                        <select name="barangnya" class = "form-control" required>
                                            <?php
                                                $ambildatabarang = mysqli_query($conn, "select * from barang");
                                                while($fetcharray = mysqli_fetch_array($ambildatabarang)){
                                                    $namabarangnya = $fetcharray['namabarang'];
                                                    $idbarangnya = $fetcharray['idbarang'];
                                            ?>
                                            <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

                                            <?php
                                                }

                                            ?>
                                        </select>
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
                                        <input type="number" name = "stock" placeholder="Stock" class="form-control" required>
                                        <br>
                                        <input type="text" name = "ket" placeholder="Keterangan" class="form-control" required>
                                        <br>
                                        <button type="submit" class="btn btn-primary" name="barangmasuk">Tambahkan</button>
                                    </div>
                                    </form>
                                        
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
</html>
