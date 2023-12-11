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
        <title>SUPPLIER</title>
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
                        <h1 class="mt-4">SUPPLIER</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">DAFTAR SUPPLIER</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                            <div class="card mb-4">
                            <div class="card-header">
                             <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Barang
                            </button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Asal Supplier</th>
                                            <th>Tindakan</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    $ambildatastock = mysqli_query($conn, "select * from supplier");
                                    $i = 1;
                                    while($data = mysqli_fetch_array($ambildatastock)){
                                        
                                        $namasup = $data['namasup'];
                                        $asalsup = $data['asalsup'];
                                        $idsup = $data['idsup']

                                        ?>
                                        <tr>
                                            <td><?=$i++; ?></td>
                                            <td><?=$namasup; ?></td>
                                            <td><?=$asalsup; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idsup;?>">
                                                    Edit
                                                </button>
                                                
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idsup;?>">
                                                    Delete
                                                </button>
                                            </td>

                                            
                                            
                                        </tr>

                                            <!-- EDI The Modal -->
                                        <div class="modal fade" id="edit<?=$idsup;?>">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">EDIT SUPPLIER</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method = "post">
                                        <div class="modal-body">
                                        <input type="text" name = "namasup" value="<?=$namasup;?>" class="form-control" required>
                                        <br>
                                        <input type="text" name = "asalsup" value="<?=$asalsup;?>" class="form-control" required>
                                        <br>
                                        <input type="hidden" name="ids" value="<?=$idsup;?>">
                                        <button type="submit" class="btn btn-primary" name = "editsup">Ubah</button>
                                        </div>
                                        </form>
                                        
                                        
                                    </div>
                                    </div>
                                    </div>

                                          <!-- Delete The Modal -->
                                          <div class="modal fade" id="delete<?=$idsup;?>">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title">DELETE SUPPLIER</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <form method = "post">
                                        <div class="modal-body">
                                        LANJUT MENGHAPUS <?=$namasup;?> ?
                                        <input type="hidden" name="ids" value="<?=$idsup;?>">
                                        <br>
                                        <br>
                                        <input type="hidden" name="idhapus" value="<?=$idsup;?>">
                                        <button type="submit" class="btn btn-danger" name = "hapussup">Hapus</button>
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
                                        <form method = "post">
                                        <div class="modal-body">
                                        <input type="text" name = "namasup" placeholder="Nama Supplier" class="form-control" required>
                                        <br>
                                        <input type="text" name = "asalsup" placeholder="Asal Supplier" class="form-control" required>
                                        <br>
                                        <button type="submit" class="btn btn-primary" name = "addsupplier">Tambahkan</button>
                                        </div>
                                        </form>
                                        
                                        
                                    </div>
                                    </div>
                                </div>
</html>
</html>
