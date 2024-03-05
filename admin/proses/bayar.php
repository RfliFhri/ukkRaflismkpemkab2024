<?php
include "connect.php";

session_start();

$kode = isset($_POST["id"]) ? htmlentities($_POST["id"]) :"";
$nama = isset($_POST["namapl"]) ? htmlentities($_POST["namapl"]) :"";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total']) : "";
$uang = (isset($_POST['uang'])) ? htmlentities($_POST['uang']) : "";
$sub = (isset($_POST['sub'])) ? htmlentities($_POST['sub']) : "";
$id_produk = (isset($_POST['id_produk'])) ? htmlentities($_POST['id_produk']) : "";
$id_detail = (isset($_POST['id_detail'])) ? htmlentities($_POST['id_detail']) : "";
$kembalian =  $uang - $total;

if(!empty($_POST['bayar_validate'])){
    if($kembalian<0){
        echo '<script>alert("Nominal Uang tidak mencukupi");
        location.href="../?x=pesanan&idpenjualan='.$kode.'&namapl='.$nama.'";</script>';
    }else{
    $query = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar, nominal_uang, total_bayar) VALUES ('$kode', '$uang', '$total')");
    if(!$query){
        echo '<script>alert("Maaf Pembayaran Anda Gagal");
        location.href="../?x=pesanan&idpenjualan='.$kode.'&namapl='.$nama.'";</script>';
    } else{
        $select = mysqli_query($conn, "SELECT * FROM tb_penjualan WHERE id_penjualan='$kode'");
        if($select){
            $subb = mysqli_query($conn, "UPDATE tb_penjualan SET total_harga='$total' WHERE id_penjualan='$kode'");
            if($subb){
                $pilih = mysqli_query($conn, "SELECT * FROM tb_detailpjl WHERE penjualan_id='$kode'");
                if($pilih){
                    $totall = mysqli_query($conn, "UPDATE tb_detailpjl SET subtotal='$sub' WHERE id_detail='$id_detail' ");
                    if($totall){
                        echo '<script>alert("Selamat Pembayaran Anda Berhasil \nUang Kembalian Anda Rp. '.$kembalian.'");
                        location.href="../?x=pesanan&idpenjualan='.$kode.'&namapl='.$nama.'";</script>';
                }
            }
        }
    }
}
}
}

?>