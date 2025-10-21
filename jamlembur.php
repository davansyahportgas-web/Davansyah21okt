<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tugas 5 - Menghitung Gaji dan Lembur Karyawan</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #f5f6fa;
      padding: 20px;
      color: #222;
    }
    h2, h3 {
      text-align: center;
      color: #333;
    }
    form, table {
      margin: 0 auto;
      width: 80%;
      border-collapse: collapse;
    }
    table {
      background: #fff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px 10px;
      text-align: center;
    }
    th {
      background-color: #3498db;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    select {
      padding: 5px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
      display: block;
      margin: 20px auto;
    }
    input[type="submit"]:hover {
      background-color: #2980b9;
    }
    p {
      text-align: center;
      color: #555;
    }
  </style>
</head>
<body>
  <h2>Program Menghitung Gaji dan Lembur Karyawan</h2>
  <p>Tanggal: <?php echo date("d-m-Y"); ?></p>

  <form method="post">
    <table>
      <tr>
        <th>No</th>
        <th>Nama Karyawan</th>
        <th>Jam Kerja</th>
      </tr>
      <?php
      $nama = ["Kevin", "Idrus", "Fadlan", "Satrio"];
      for ($i = 0; $i < count($nama); $i++) {
          echo "<tr>
                  <td>".($i+1)."</td>
                  <td>$nama[$i]</td>
                  <td>
                    <select name='jamKerja[]' required>
                      <option value=''>--Jam kerja--</option>";
                      for ($j = 30; $j <= 55; $j += 5) {
                          echo "<option value='$j'>$j jam</option>";
                      }
          echo "    </select>
                  </td>
                </tr>";
      }
      ?>
    </table>
    <input type="submit" name="hitung" value="Hitung Gaji">
  </form>

  <?php
  if (isset($_POST['hitung'])) {
      $jamKerja = $_POST['jamKerja'];
      $nama = ["Andi", "Budi", "Citra", "Dodi"];
      $tarifNormal = 20000;
      $tarifLembur = 25000;
      $batasJamNormal = 40;

      echo "<h3>Hasil Perhitungan Gaji</h3>";
      echo "<table>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jam Kerja</th>
        <th>Jam Normal</th>
        <th>Jam Lembur</th>
        <th>Gaji Normal</th>
        <th>Gaji Lembur</th>
        <th>Total Gaji</th>
      </tr>";

      $totalSemua = 0;

      for ($i = 0; $i < count($nama); $i++) {
          $jam = (int)$jamKerja[$i];
          if ($jam > $batasJamNormal) {
              $jamNormal = $batasJamNormal;
              $jamLembur = $jam - $batasJamNormal;
          } else {
              $jamNormal = $jam;
              $jamLembur = 0;
          }

          $gajiNormal = $jamNormal * $tarifNormal;
          $gajiLembur = $jamLembur * $tarifLembur;
          $totalGaji = $gajiNormal + $gajiLembur;
          $totalSemua += $totalGaji;

          echo "<tr>
                  <td>".($i+1)."</td>
                  <td>$nama[$i]</td>
                  <td>$jam jam</td>
                  <td>$jamNormal jam</td>
                  <td>$jamLembur jam</td>
                  <td>Rp ".number_format($gajiNormal,0,',','.')."</td>
                  <td>Rp ".number_format($gajiLembur,0,',','.')."</td>
                  <td>Rp ".number_format($totalGaji,0,',','.')."</td>
                </tr>";
      }

      echo "<tr style='font-weight:bold; background:#eaf4ff;'>
              <td colspan='7'>Total Gaji Seluruh Karyawan</td>
              <td>Rp ".number_format($totalSemua,0,',','.')."</td>
            </tr>";
      echo "</table>";
  }
  ?>
</body>
</html>