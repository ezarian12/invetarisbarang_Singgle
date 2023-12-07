<?php
session_start();

//koneksi database
$conn = mysqli_connect("localhost","root","","invetarisbarang");

//menambah barang
if(isset($_POST['addbarang'])){
    $namabarang = $_POST['namabarang'];
    $satuannya = $_POST['satuannya'];
    $supnya = $_POST['supnya'];
    $total = $_POST['total'];
    $harga = $_POST['harga'];

    $addtobarang = mysqli_query ($conn, "insert into barang (namabarang, idsatuan, idsup, total, harga) values('$namabarang','$satuannya','$supnya','$total','$harga')");
    if ($addtobarang){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//menambah supplier
if(isset($_POST['addsupplier'])){
    $namasup = $_POST['namasup'];
    $asalsup = $_POST['asalsup'];
    

    $addtosup = mysqli_query ($conn, "insert into supplier (namasup, asalsup) values('$namasup','$asalsup')");
    if ($addtosup){
        header('location:sup.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//menambah satuan
if(isset($_POST['addsatuan'])){
    $namasatuan = $_POST['namasatuan'];

    $addtosatuan = mysqli_query ($conn, "insert into satuan (namasatuan) values('$namasatuan')");
    if ($addtosatuan){
        header('location:satuan.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $satuannya = $_POST['satuannya'];
    $supnya = $_POST['supnya'];
    $stock = $_POST['stock'];
    $ket = $_POST['ket'];

    $cekstock = mysqli_query($conn, "select * from barang where idbarang = '$barangnya'");
    $ambildata = mysqli_fetch_array($cekstock);

    $stockskrng = $ambildata['total'];
    $tmbhstock = $stockskrng+$stock;

    $addtomasuk = mysqli_query ($conn, "insert into bar_masuk (idbarang, idsatuan, idsup, stock, ket) values('$barangnya','$satuannya','$supnya','$stock','$ket')");
    $updatemasuk = mysqli_query ($conn, "update barang set total= '$tmbhstock' where idbarang='$barangnya'");
    if ($addtomasuk){
        header('location:barang_masuk.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//menambah barang keluar
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $satuannya = $_POST['satuannya'];
    $stock = $_POST['stock'];
    $ket = $_POST['ket'];

    $cekstock = mysqli_query($conn, "select * from barang where idbarang = '$barangnya'");
    $ambildata = mysqli_fetch_array($cekstock);

    $stockskrng = $ambildata['total'];
    if($stockskrng >= $stock){
        $tmbhstock = $stockskrng-$stock;

        $addtokeluar = mysqli_query ($conn, "insert into bar_keluar (idbarang, idsatuan, stock, ket) values('$barangnya','$satuannya','$stock','$ket')");
        $updatekeluar = mysqli_query ($conn, "update barang set total= '$tmbhstock' where idbarang='$barangnya'");
        if ($addtokeluar){
            header('location:barang_keluar.php');
        } else {
            echo 'gagal';
            header('location.index.php');
        }

    } else {
        //barang melebihi
        echo'
        <script>
            alert("Jumlah stock keluar melebihi stock tersedia");
            window.location.href="barang_keluar.php";
            </script>
            ';
    } 
}

//menambah supplier
if(isset($_POST['adduser'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usernya = $_POST['usernya'];
    

    $addtouser = mysqli_query ($conn, "insert into login (email, password, role) values('$email','$password','$usernya')");
    if ($addtouser){
        header('location:admin.php');
    } else {
        echo 'gagal';
        header('location.admin.php');
    }

}

//edit barang
if(isset($_POST['editbarang'])){
    $idbar = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $harga = $_POST['harga'];
    $satuannya = $_POST['satuannya'];
    $supnya = $_POST['supnya'];
    $total = $_POST['total'];
    

    $editbarang = mysqli_query ($conn, "update barang set namabarang='$namabarang', harga='$harga' , idsatuan= '$satuannya' , idsup = '$supnya' , total='$total' where idbarang='$idbar'");
    if ($editbarang){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//delete barang
if(isset($_POST['hapusbarang'])){
    $idbar = $_POST['idbarang'];
    
    
    

    $hapusbarang = mysqli_query ($conn, "delete from barang where idbarang= '$idbar'");
    if ($hapusbarang){
        header('location:index.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//edit supplier
if(isset($_POST['editsup'])){
    $idsup = $_POST['ids'];
    $namasup = $_POST['namasup'];
    $asalsup = $_POST['asalsup'];
    

    $editsup = mysqli_query ($conn, "update supplier set namasup='$namasup', asalsup='$asalsup' where idsup='$idsup'");
    if ($editsup){
        header('location:sup.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//delete supplier
if(isset($_POST['hapussup'])){
    $idsup = $_POST['ids'];
    
    

    $hapussup = mysqli_query ($conn, "delete from supplier where idsup= '$idsup'");
    if ($hapussup){
        header('location:sup.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}


//edit satuan
if(isset($_POST['editsat'])){
    $idsatuan = $_POST['idsatuan'];
    $namasatuan = $_POST['namasatuan'];
    
    

    $editsatuan = mysqli_query ($conn, "update satuan set namasatuan='$namasatuan' where idsatuan='$idsatuan'");
    if ($editsatuan){
        header('location:satuan.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//delete satuan
if(isset($_POST['hapussat'])){
    $idsatuan = $_POST['idsatuan'];
    
    

    $hapussat = mysqli_query ($conn, "delete from satuan where idsatuan= '$idsatuan'");
    if ($hapussat){
        header('location:satuan.php');
    } else {
        echo 'gagal';
        header('location.index.php');
    }

}

//edit masuk
if(isset($_POST['editmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $ket = $_POST['ket'];
    $stock = $_POST['stock'];
    
    $lihattotal = mysqli_query ($conn, "select * from barang where idbarang = '$idb'");
    $totalnya = mysqli_fetch_array($lihattotal);
    $totalskrng = $totalnya['total'];

    $stocksk = mysqli_query($conn, "select * from bar_masuk where idmasuk='$idm'");
    $stocknya = mysqli_fetch_array($stocksk);
    $stocksk = $stocknya['stock'];

    if($stock>$stockskrng){
        $selisih = $stock - $stocksk;
        $kurangin = $totalskrng + $selisih;
        $kurangistock = mysqli_query($conn, "update barang set total='$kurangin' where idbarang='$idb' ");
        $update = mysqli_query($conn, "update bar_masuk set stock='$stock', ket='$ket' where idmasuk='$idm'");
            if($kurangistock&&$update){
                header('location:barang_masuk.php');

            }else{
                echo 'gagal';
                header('location:barang_masuk.php');
            }
    } else {
        $selisih = $stocksk - $stock;
        $kurangin = $totalskrng - $selisih;
        $kurangistock = mysqli_query($conn, "update barang set total='$kurangin' where idbarang='$idb' ");
        $update = mysqli_query($conn, "update bar_masuk set stock='$stock', ket='$ket' where idmasuk='$idm'");

        if($kurangistock&&$update){
            header('location:barang_masuk.php');

        }else{
            echo 'gagal';
            header('location:barang_masuk.php');
        }
    }



}

//delete masuk
if(isset($_POST['hapusmasuk'])){
    $idb = $_POST['idb'];
    $stock = $_POST['stock'];
    $idm = $_POST['idm'];
    

    $getdatastock = mysqli_query($conn, "select * from barang where idbarang = '$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $qty = $data['total'];

    $range = $qty-$stock;

    $update = mysqli_query($conn, "update barang set total ='$range' where idbarang = '$idb'");
    $hapusdata = mysqli_query($conn, "delete from bar_masuk where idmasuk = '$idm'");

    if($update&&$hapusdata){
        header('location:barang_masuk.php');
    } else {
        header('location:barang_masuk.php');
    }
}

//edit keluar
if(isset($_POST['editkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $ket = $_POST['ket'];
    $stock = $_POST['stock'];
    
    $lihattotal = mysqli_query ($conn, "select * from barang where idbarang = '$idb'");
    $totalnya = mysqli_fetch_array($lihattotal);
    $totalskrng = $totalnya['total'];

    $stocksk = mysqli_query($conn, "select * from bar_keluar where idkeluar='$idk'");
    $stocknya = mysqli_fetch_array($stocksk);
    $stocksk = $stocknya['stock'];

    if($stock>$stockskrng){
        $selisih = $stock - $stocksk;
        $kurangin = $totalskrng + $selisih;
        $kurangistock = mysqli_query($conn, "update barang set total='$kurangin' where idbarang='$idb' ");
        $update = mysqli_query($conn, "update bar_keluar set stock='$stock', ket='$ket' where idkeluar='$idk'");
            if($kurangistock&&$update){
                header('location:barang_keluar.php');

            }else{
                echo 'gagal';
                header('location:barang_keluar.php');
            }
    } else {
        $selisih = $stocksk - $stock;
        $kurangin = $totalskrng - $selisih;
        $kurangistock = mysqli_query($conn, "update barang set total='$kurangin' where idbarang='$idb' ");
        $update = mysqli_query($conn, "update bar_keluar set stock='$stock', ket='$ket' where idkeluar='$idk'");

        if($kurangistock&&$update){
            header('location:barang_keluar.php');

        }else{
            echo 'gagal';
            header('location:barang_keluar.php');
        }
    }



}

//delete keluar
if(isset($_POST['hapuskeluar'])){
    $idb = $_POST['idb'];
    $stock = $_POST['stock'];
    $idk = $_POST['idk'];
    

    $getdatastock = mysqli_query($conn, "select * from barang where idbarang = '$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $qty = $data['total'];

    $range = $qty+$stock;

    $update = mysqli_query($conn, "update barang set total ='$range' where idbarang = '$idb'");
    $hapusdata = mysqli_query($conn, "delete from bar_keluar where idkeluar = '$idk'");

    if($update&&$hapusdata){
        header('location:barang_keluar.php');
    } else {
        header('location:barang_keluar.php');
    }
}

//edit user
if(isset($_POST['edituser'])){
    $iduser = $_POST['iduser'];
    $emailbaru = $_POST['emailadmin'];
    $pwbaru= $_POST['passwordbaru'];
    $userbaru = $_POST['usernya'];
    
    

    $editadmin = mysqli_query ($conn, "update login set email='$emailbaru', password='$pwbaru' , iduser= '$usernya'   where iduser='$iduser'");
    if ($editadmin){
        header('location:admin.php');
    } else {
        echo 'gagal';
        header('location.admin.php');
    }

}

//delete user
if(isset($_POST['hapususer'])){
    $iduser = $_POST['iduser'];
    
    

    $hapusadmin = mysqli_query ($conn, "delete from login where iduser = '$iduser'");
    if ($hapusadmin){
        header('location:admin.php');
    } else {
        echo 'gagal';
        header('location.admin.php');
    }

}



?>