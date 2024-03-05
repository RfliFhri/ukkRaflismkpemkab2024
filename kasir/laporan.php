<?php

include "proses/connect.php";

if(isset($_POST['pilih'])){
    $mulai = mysqli_real_escape_string($conn, $_POST['mulai']);
    $query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah_produk) AS harganya FROM tb_penjualan 
    LEFT JOIN tb_pelanggan ON tb_pelanggan.id_pelanggan = tb_penjualan.pelanggan_id
    LEFT JOIN tb_detailpjl ON tb_detailpjl.penjualan_id = tb_penjualan.id_penjualan 
    LEFT JOIN tb_produk ON tb_produk.id_produk = tb_detailpjl.produk_id
    JOIN tb_bayar ON tb_bayar.id_bayar = tb_penjualan.id_penjualan WHERE tanggal_penjualan='$mulai' GROUP BY id_penjualan");
} else {
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah_produk) AS harganya FROM tb_penjualan 
LEFT JOIN tb_pelanggan ON tb_pelanggan.id_pelanggan = tb_penjualan.pelanggan_id
LEFT JOIN tb_detailpjl ON tb_detailpjl.penjualan_id = tb_penjualan.id_penjualan 
LEFT JOIN tb_produk ON tb_produk.id_produk = tb_detailpjl.produk_id
JOIN tb_bayar ON tb_bayar.id_bayar = tb_penjualan.id_penjualan
GROUP BY id_penjualan ORDER BY id_bayar ASC");
}

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
$select_pelanggan = mysqli_query($conn, "SELECT id_pelanggan, nama_pelanggan FROM tb_pelanggan");
?>

<div class="content px-3 py-2">
    <div class="card">
        <h5 class="card-header">Laporan Harian</h5>
        <div class="card-body">
            <?php 
            $total= 0;
            if(empty($result)){
                echo "";
            } else {
            foreach( $result as $row) {
                $total+=$row["harganya"];
            }
        }
             ?>
        <div class="row">
            <div class="col-lg-4">
             <div class="form-floating mb-3">
             <input type="text" class="form-control" id="floatingInput" required value="<?php echo 'Rp ', number_format($total, 0, ',', '.')   ?>" disabled>
             <label for="floatingInput">Total Penjualan</label>
           </div>
       </div>
       <div class="col-lg-1">
        <a href="datapjl" class="btn btn-dark border-light">Back</a>
       </div>
       <div class="col-lg-4">
        <form method="POST" class="d-flex">
        <input type="date" class="form-control me-2" name="mulai">
        <button class="btn btn-primary" type="submit" name="pilih">Pilih</button>
    </form>
</div>
<div class="col-lg-2">
        <button onclick="printStruk()" class="<?php echo (!isset($_POST['pilih'])) ? 'btn btn-secondary disabled' : 'btn btn-primary' ; ?>">Cetak Laporan</button>
    </div>
      </div>

            <?php
            if (empty($result)) {
            echo "Tidak ada Penjuaan untuk hari ini";
            } else {
            foreach ($result as $row) {
            ?>

            <?php 
            }
            ?>
             <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr >
                        <th scope="col">No</th>
                        <th scope="col">Id Penjualan</th>
                        <th scope="col">Tanggal Penjualan</th>
                        <th scope="col">Waktu Bayar</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Pelanggan</th>
                        <th scope="col">Aksi</th>
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
                                <?php echo date('d-m-Y',strtotime($row['tanggal_penjualan'])) ?>
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
                           <td class="d-flex">
                            <a class="btn btn-info btn-sm me-1" href="./?x=pesanan&idpenjualan=<?php echo $row['id_penjualan']."&namapl=".$row['nama_pelanggan'] ?>"><i class="bi bi-cart-plus"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
             </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-------------------------------------------------- Laporan Harian ----------------------------------------------------->
  <div id="Struk" class="d-none">
  <style>
    #struk {
      font-family: Arial, sans-serif;
      font-size: 20px;
      max-width: 100%;
      border: 1px solid #ccc;
      padding: 10px;
      width: 600px;
    }
    #struk h2{
        font-size: 25px;
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }
    #struk p {
      margin: 10px 0;
    }
    #struk table{
        text-align: center;
      font-size: 18px;
      border-collapse: collapse;
      margin-top: 25px;
      width: 100%;
    }
    #struk th, #struk td{
      border: 1px solid #ddd;
      padding: 8px;
    }
    #struk .total{
      font-weight: bold;
    }
  </style>
  <div id="struk">
  <h2>Laporan Harian</h2>
  <p>Tanggal Pejualan : <?php echo date('d/m/Y', strtotime($result[0]['tanggal_penjualan'])) ?></p>
  <p>Total Penjualan : <?php echo 'Rp ', number_format($total, 2,',','.') ?></p>
  <table class="table table-responsive num-rows" >
  <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Id Penjualan</th>
                        <th scope="col">Waktu Pembayaran</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Pelanggan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
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
                                <?php echo 'Rp ', number_format($row['harganya'], 2, ',', '.') ?>
                            </td>
                            <td>
                                <?php echo $row['nama_pelanggan'] ?>
                            </td>
                        </tr>
                    <?php 
                    
                    } 
                    ?>
                </tbody>
  </table>
  </div>
</div>

<script>
  function printStruk() {
    var Struk = document.getElementById("Struk").innerHTML;

    var Print = document.createElement('iframe');
    Print.style.display = 'none';
    document.body.appendChild(Print);
    Print.contentDocument.write(Struk);
    Print.contentWindow.print();
    document.body.removeChild(Print);

  }
</script>