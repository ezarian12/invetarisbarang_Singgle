<?php
require 'function.php';
require 'cek.php'
?>
<html>
<head>
        <title>LIST BARANG MASUK </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class ="container">
        <h2>LIST BARANG KELUAR</h2>
        <h4>(Inventory)</h4>
        <div class ="data-tables datatable-dark">
        <br>
                            <div class="row mt-4">
                            <div class="col">
                                <form method = "post" class="form-inline">
                                    <input type="date" name="tgl_mulai" class = "form-control">
                                    <input type="date" name="tgl_usai" class = "form-control">
                                    <button type="submit" name="filter_tgl" class="btn btn-info ml-3">Filter</button>
                            </div>
                            </div>

        <table class="table table-bordered" id="mauexport_bk" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                            <th>Tanggal Masuk</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            
                                            <th>Stock</th>
                                            <th>Keterangan</th>
                                            

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if(isset($_POST['filter_tgl'])){
                                            $mulai = $_POST['tgl_mulai'];
                                            $usai = $_POST['tgl_usai'];

                                            if($mulai!=null || $usai!=null){
                                                $ambildatastock1 = mysqli_query($conn, "select bar_keluar.*, barang.namabarang, satuan.namasatuan FROM bar_keluar INNER JOIN barang ON bar_keluar.idbarang=barang.idbarang INNER JOIN satuan ON bar_keluar.idsatuan=satuan.idsatuan and tgl BETWEEN '$mulai' and DATE_ADD('$usai',INTERVAL 1 DAY) order by idkeluar DESC");
                                            } else {
                                                $ambildatastock1 = mysqli_query($conn, "select bar_keluar.*, barang.namabarang, satuan.namasatuan FROM bar_keluar INNER JOIN barang ON bar_keluar.idbarang=barang.idbarang INNER JOIN satuan ON bar_keluar.idsatuan=satuan.idsatuan order by idkeluar DESC");
                                            }

                                        } else{
                                            $ambildatastock1 = mysqli_query($conn, "select bar_keluar.*, barang.namabarang, satuan.namasatuan FROM bar_keluar INNER JOIN barang ON bar_keluar.idbarang=barang.idbarang INNER JOIN satuan ON bar_keluar.idsatuan=satuan.idsatuan order by idkeluar DESC");
                                        }
                                            while($data = mysqli_fetch_array($ambildatastock1)){
                                                $idk = $data['idkeluar'];
                                                $idb = $data['idbarang'];
                                                $tgl = $data['tgl'];
                                                $namabarang = $data['namabarang'];
                                                $namasatuan = $data['namasatuan'];
                                                $ket = $data['ket'];
                                                $stock = $data['stock'];
                                                

                                            

                                        ?>
                                        <tr>
                                            <td><?php echo $tgl;?></td>
                                            <td><?php echo $namabarang; ?></td>
                                            <td><?php echo $namasatuan; ?></td>
                                            <td><?php echo $stock; ?></td>
                                            <td><?php echo $ket; ?></td>
                                            
                         
                                        </tr>
                                        </div>

                                        <?php
                                        };

                                        ?>

                                        </tbody>
                                    
                                    
                                </table>

        </div>
</div>

<script>
    $(document).ready(function() {
        $('#mauexport_bk').DataTable( {
            order: [[ 2, "desc" ]],
            dom: 'Bfrtip',
            buttons: [
                 'excel' , 'pdf' , 'print'
            ]
        } );
    } );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>


</body>

</html>


