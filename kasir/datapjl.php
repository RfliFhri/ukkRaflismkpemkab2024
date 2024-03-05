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
$select_pelanggan = mysqli_query($conn, "SELECT id_pelanggan, nama_pelanggan FROM tb_pelanggan");
?>

<div class="content px-3 py-2">
    <div class="card">
        <h5 class="card-header">Total Penjualan</h5>
        <div class="card-body">
            <?php 
            $total= 0;
            if(empty($result)) {
                $pesan = "tidak ada produk yang terjual";
            }else{
            foreach( $result as $row) {
                $total+=$row["harganya"];
            }
        }
             ?>
        <div class="row">
            <div class="col-lg-5">
             <div class="form-floating mb-3">
             <input type="text" class="form-control" id="floatingInput" required value="<?php echo 'Rp ', number_format($total, 0, ',', '.')   ?>" disabled>
             <label for="floatingInput">Total Penjualan</label>
           </div>

       </div>
       <div class="col-lg-7">
       <div class="column d-flex justify-content-start">
                <a href="perbulan" class="btn <?php echo (empty($result)) ? "btn-secondary disabled" : "btn-primary" ; ?> me-2" > Hitung melalui tanggal</a>
                <a href="laporan" class="btn <?php echo (empty($result)) ? "btn-secondary disabled" : "btn-success" ; ?> me-2" > Laporan Harian</a>
                
            </div>
       </div>
            </div>

            <?php

            if (empty($result)) {
            echo "<b>Data Penjualan tidak ada</b>";
            } else {
            foreach ($result as $row) {
            ?>

            <?php 
            }
            ?>
             <div class="table-responsive">
            <table class="table table-hover" id="example">
                <thead>
                    <tr class="text-nowrap" >
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
                        <tr class="text-center">
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
                            <a class="btn btn-info btn-sm me-1" href="./?x=datapsnan&idpenjualan=<?php echo $row['id_penjualan']."&namapl=".$row['nama_pelanggan'] ?>"><i class="bi bi-cart-plus"></i></a>
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

<script>
    $(document).ready( function () {
    $('#example').DataTable();
} );
</script>

                                            <!-- Laporan Harian -->
  <div id="Struk" class="d-none">
  <style>
    #struk {
      font-family: Arial, sans-serif;
      font-size: 12px;
      max-width: 100%;
      border: 1px solid #ccc;
      padding: 10px;
      width: 600px;
    }
    #struk h2{
      text-align: center;
      color: #333;
    }
    #struk p {
      margin: 5px 0;
    }
    #struk table{
      font-size: 12px;
      border-collapse: collapse;
      margin-top: 10px;
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
  <h2>Laporan Harian </h2>
  <p>Tanggal: </p>
  <p>Total Penjualan: </p>

  <table class="table table-responsive num-rows" >
  <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Id Penjualan</th>
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
                               
                            </td>
                            <td>
                                
                            </td>
                            <td>
                               
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