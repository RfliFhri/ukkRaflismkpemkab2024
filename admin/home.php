<?php

include "proses/connect.php";

$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah_produk) AS harganya FROM tb_penjualan 
LEFT JOIN tb_pelanggan ON tb_pelanggan.id_pelanggan = tb_penjualan.pelanggan_id
LEFT JOIN tb_detailpjl ON tb_detailpjl.penjualan_id = tb_penjualan.id_penjualan 
LEFT JOIN tb_produk ON tb_produk.id_produk = tb_detailpjl.produk_id
JOIN tb_bayar ON tb_bayar.id_bayar = tb_penjualan.id_penjualan
GROUP BY id_penjualan ORDER BY id_bayar ASC");
                
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$query_chart = mysqli_query($conn,"SELECT nama,tb_penjualan.*,tb_bayar.waktu_bayar,tb_pelanggan.nama_pelanggan, tb_produk.id_produk, SUM(harga*jumlah_produk) AS harganya, SUM(tb_detailpjl.jumlah_produk) AS total_jumlah FROM tb_produk 
LEFT JOIN tb_detailpjl ON tb_detailpjl.produk_id = tb_produk.id_produk
LEFT JOIN tb_penjualan ON tb_penjualan.id_penjualan = tb_detailpjl.penjualan_id
LEFT JOIN tb_pelanggan ON tb_pelanggan.id_pelanggan = tb_penjualan.pelanggan_id
JOIN tb_bayar ON tb_bayar.id_bayar = tb_penjualan.id_penjualan
GROUP BY tb_produk.id_produk ORDER BY tb_produk.id_produk ASC ");

while ($record_chart = mysqli_fetch_array($query_chart)) {
    $result_chart[] = $record_chart;
}
if(empty($result_chart)) {
    $pesan = "<b>Selamat Datang ".$_SESSION['nama_admin']."</b> <br> Tidak dapat menampilkan chart <b>Karena</b> tidak ada produk yang terjual";
}else{
$array_menu = array_column($result_chart,"nama");
$array_menu_qoute = array_map(function ($menu){
  return "'". $menu ."'";
}, $array_menu);
$string_menu = implode(",", $array_menu_qoute);

$array_jumlah_pesanan = array_column($result_chart, "total_jumlah");
$string_jumlah_pesanan = implode(',', $array_jumlah_pesanan);

//  line chart
// Inisialisasi array untuk menyimpan data bulan dan total penjualan
$data_per_bulan = array();

// Lakukan query
$query_chart_line = mysqli_query($conn, "SELECT MONTH(tb_bayar.waktu_bayar) AS bulan, 
                                           SUM(harga*jumlah_produk) AS total_penjualan
                                    FROM tb_produk 
                                    LEFT JOIN tb_detailpjl ON tb_detailpjl.produk_id = tb_produk.id_produk
                                    LEFT JOIN tb_penjualan ON tb_penjualan.id_penjualan = tb_detailpjl.penjualan_id
                                    LEFT JOIN tb_pelanggan ON tb_pelanggan.id_pelanggan = tb_penjualan.pelanggan_id
                                    JOIN tb_bayar ON tb_bayar.id_bayar = tb_penjualan.id_penjualan
                                    WHERE tb_bayar.waktu_bayar BETWEEN DATE_SUB(NOW(), INTERVAL 1 YEAR) AND NOW()
                                    GROUP BY MONTH(tb_bayar.waktu_bayar)
                                    ORDER BY MONTH(tb_bayar.waktu_bayar) ASC");

// Periksa apakah query berhasil dijalankan
if (!$query_chart_line) {
    echo "Error dalam query: " . mysqli_error($conn);
    exit();
}

// Inisialisasi array untuk menyimpan total penjualan untuk setiap bulan
$total_penjualan_per_bulan = array_fill(1, 12, 0);

// Loop melalui hasil query untuk mengambil data bulan dan total penjualan
while ($row = mysqli_fetch_assoc($query_chart_line)) {
    $bulan = $row['bulan'];
    $total_penjualan_per_bulan[$bulan] = $row['total_penjualan'];
}

// Buat array untuk nama bulan
$nama_bulan = array(
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
);

// Inisialisasi array untuk menyimpan total penjualan per bulan dalam format yang sesuai dengan nama bulan
$data_per_bulan = array();
foreach ($total_penjualan_per_bulan as $bulan => $total_penjualan) {
    $data_per_bulan[$nama_bulan[$bulan]] = $total_penjualan;
}

// Buat string untuk label bulan
$string_bulan = "'" . implode("', '", array_keys($data_per_bulan)) . "'";

// Buat string untuk total penjualan per bulan
$string_total_penjualan = implode(", ", $data_per_bulan);
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-12 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-12">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, <?php echo $_SESSION['nama_admin'] ?></h4>
                                                <p class="mb-1">Admin Dashboard, Elray</p>
                                                <p class="mb-0">Berikut adalah tampilan Chart dari Total Penjualan yang mengmbil data dari waktu pembayaran dan Chart Jumlah Produk yang sudah terjual. Di halaman ini juga menampilkan Tabel Penjualan Jika ingin melihat Data Penjualan yang lebih detail klik link berikut <a href="datapjln" style="text-decoration: underline; font-style: italic;">Detail</a>. Atau bisa klik Data Penjualan di menu Sidebars</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="asset/image/customer-support.jpg" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                    <div class="col-12 col-md-6 d-flex">  
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                        <?php if (empty($result_chart)) { ?>
                                            
                                                <h5 class="">Home</h5>
                                                <div class="">
                                                    <p class=""> <?php echo (empty($result_chart)) ? $pesan : "" ; ?> </p>
                                                </div>
                                            
                                            <?php }else{ ?>
                                                <div>
                                                    <canvas id="myChart1"></canvas>
                                                </div>
                                                <script>
                                                    const ctx1 = document.getElementById('myChart1');

                                                    new Chart(ctx1, {
                                                        type: 'line',
                                                        data: {
                                                            labels: [<?php echo $string_bulan ?>],
                                                            datasets: [{
                                                                label: 'Total Penjualan',
                                                                data: [<?php echo $string_total_penjualan ?>],
                                                                borderWidth: 1,
                                                                borderColor:'rgb(0, 0, 255)'
                                                            }]
                                                        },
                                                        options: {
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 d-flex">  
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                        <?php if (empty($result_chart)) { ?>
                                            
                                                <h5 class="">Home</h5>
                                                <div class="">
                                                    <p class=""> <?php echo (empty($result_chart)) ? $pesan : "" ; ?> </p>
                                                </div>
                                            
                                            <?php }else{ ?>
                                                <div>
                                                    <canvas id="myChart2"></canvas>
                                                </div>
                                                <script>
                                                    const ctx2 = document.getElementById('myChart2');

                                                    new Chart(ctx2, {
                                                        type: 'bar',
                                                        data: {
                                                            labels: [<?php echo $string_menu ?>],
                                                            datasets: [{
                                                                label: 'Jumlah produk terjual',
                                                                data: [<?php echo $string_jumlah_pesanan ?>],
                                                                borderWidth: 1,
                                                                backgroundColor:['rgba(255, 0, 0, 0.39)', 'rgba(0, 0, 255, 0.37)', 'rgba(231, 255, 0, 0.37)', 'rgba(0, 255, 3, 0.37)', 'rgba(236, 0, 255, 0.37)', 'rgba(255, 189, 0, 0.37)']
                                                            }]
                                                        },
                                                        options: {
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                   <?php if (empty($result_chart)) {
                    echo "<b>Tidak dapat menampilkan <b>Tabel Penjualan</b> Karena tidak ada <b>Data Penjualan</b></b>";
                    } else {
                    foreach ($result_chart as $row) {
                    ?>

                    <?php 
                    }
                    ?>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Tabel Penjualan
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Id Penjualan</th>
                                    <th scope="col">Waktu Bayar</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Pelanggan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no = 1;
                                foreach ($result as $row) {
                                ?>
                                    <tr>
                                    <th scope="row">
                                        <?php echo $no++ ?>
                                    </th>
                                    <td>
                                        <?php echo $row['id_penjualan'] ?>
                                    </td>
                                    <td>
                                        <?php echo date('d/m/Y H:i:s', strtotime($row['waktu_bayar'])) ?>
                                    </td>
                                    <td>
                                        <?php echo 'Rp ', number_format($row['harganya'], 2, ',', '.')  ?>
                                    </td>
                                    <td>
                                        <?php echo $row['nama_pelanggan'] ?>
                                    </td>
                                    </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </main>