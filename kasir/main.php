<?php

if(isset($_GET['x']) && $_GET['x']=="pesanan"){
    include "pesanan.php";
}elseif(isset($_GET['x']) && $_GET['x']=="penjualan"){
    include "penjualan.php";
}elseif(isset($_GET['x']) && $_GET['x']=="pelanggan"){
    include "pelanggan.php";
}elseif(isset($_GET['x']) && $_GET['x']=="produk" || !isset($_GET['x'])){
    include "produk.php";
}elseif(isset($_GET['x']) && $_GET['x']=="datapjl"){
    include "datapjl.php";
}elseif(isset($_GET['x']) && $_GET['x']=="datapsnan"){
    include "datapsnan.php";
}elseif(isset($_GET['x']) && $_GET['x']=="perbulan"){
    include "perbulan.php";
}elseif(isset($_GET['x']) && $_GET['x']=="laporan"){
    include "laporan.php";
}
?>