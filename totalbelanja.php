<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tugas 2 - Total Belanja dan Diskon</title>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f7f7f7;
    padding: 30px;
  }
  .nota {
    background: #fff;
    border: 1px solid #000;
    padding: 30px 40px;
    width: 750px;
    margin: auto;
    border-radius: 10px;
  }
  h2 {
    text-align: center;
    text-decoration: underline;
    margin-bottom: 20px;
  }
  .info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  input[type="text"], input[type="number"], select {
    padding: 6px;
    width: 100%;
    border: 1px solid #aaa;
    border-radius: 5px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }
  th, td {
    border: 1px solid #000;
    padding: 8px;
    text-align: center;
  }
  th {
    background: #eee;
  }
  .btn {
    margin-top: 15px;
    padding: 8px 20px;
    background: #2196f3;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
  }
  .btn:hover {
    background: #1976d2;
  }
  .total {
    text-align: right;
    font-weight: bold;
    margin-top: 10px;
  }
  .ttd {
    display: flex;
    justify-content: space-between;
    margin-top: 60px;
  }
  .garis {
    margin-top: 50px;
    border-top: 1px solid #000;
    width: 150px;
  }
  .catatan {
    font-size: 14px;
    color: #555;
    margin-top: 10px;
  }
</style>
</head>
<body>
<div class="nota">
  <h2>NOTA BELANJA</h2>

  <div class="info">
    <div>
      <p>Kepada: <input type="text" name="nama" placeholder="Nama pembeli"></p>
      <p>Alamat: <input type="text" name="alamat" placeholder="Alamat pembeli"></p>
    </div>
    <div>
      <p>Nota No: <input type="text" name="nota_no" placeholder="001"></p>
      <p>Tanggal: <?php echo date("d/m/Y"); ?></p>
    </div>
  </div>

  <form method="post">
    <table>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Banyaknya</th>
      </tr>

      <?php
      // daftar harga barang (udah include harga)
      $barang = [
        "Pensil - Rp3.000" => 3000,
        "Pulpen - Rp5.000" => 5000,
        "Buku Tulis - Rp10.000" => 10000,
        "Penghapus - Rp2.000" => 2000,
        "Penggaris - Rp4.000" => 4000,
        "Crayon - Rp25.000" => 25000,
        "Spidol - Rp8.000" => 8000,
        "Tempat Pensil - Rp35.000" => 35000,
        "Tas Sekolah - Rp120.000" => 120000,
        "Kotak Makan - Rp45.000" => 45000
      ];

      // tampilkan 5 baris input barang
      for ($i = 1; $i <= 5; $i++) {
        echo "
        <tr>
          <td>$i</td>
          <td>
            <select name='barang[]'>
              <option value=''>-- Pilih Barang --</option>";
              foreach ($barang as $nama => $harga) {
                echo "<option value='$nama'>$nama</option>";
              }
        echo "</select></td>
          <td><input type='number' name='banyak[]' min='1'></td>
        </tr>";
      }
      ?>
    </table>

    <center><button type="submit" name="hitung" class="btn">Hitung Total</button></center>
  </form>

  <?php
  if (isset($_POST['hitung'])) {
    $barangDipilih = $_POST['barang'];
    $banyak = $_POST['banyak'];

    echo "<br><h3>Rincian Belanja:</h3>";
    echo "<table>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Banyak</th>
              <th>Harga Satuan</th>
              <th>Diskon</th>
              <th>Total</th>
            </tr>";

    $no = 1;
    $total = 0;

    foreach ($barangDipilih as $key => $namaBarang) {
      if ($namaBarang == "") continue;

      $harga = $barang[$namaBarang];
      $jumlah = $banyak[$key];
      $diskon = 0;

      // jika harga > 30000, dapat diskon 10%
      if ($harga > 30000) {
        $diskon = $harga * 0.1;
      }

      $hargaAkhir = $harga - $diskon;
      $subtotal = $hargaAkhir * $jumlah;
      $total += $subtotal;

      echo "<tr>
              <td>$no</td>
              <td>$namaBarang</td>
              <td>$jumlah</td>
              <td>Rp".number_format($harga,0,',','.')."</td>
              <td>".($diskon > 0 ? '10%' : '-')."</td>
              <td>Rp".number_format($subtotal,0,',','.')."</td>
            </tr>";
      $no++;
    }

    echo "</table>";
    echo "<p class='total'>Total Akhir: Rp".number_format($total,0,',','.')."</p>";
    echo "<p class='catatan'>*Diskon otomatis 10% untuk barang di atas Rp30.000</p>";
  }
  ?>

  <div class="ttd">
    <div>
      <p>Tanda Terima,</p>
      <div class="garis"></div>
    </div>
    <div>
      <p>Hormat Kami,</p>
      <div class="garis"></div>
    </div>
  </div>
</div>
</body>
</html>
