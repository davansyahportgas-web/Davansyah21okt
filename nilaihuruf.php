<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Nilai Siswa - SMKN 3 Palu</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #eef9f0;
      margin: 0;
      padding: 0;
    }

    .header {
      background: linear-gradient(135deg, #2e8b57, #4cc17e);
      color: white;
      text-align: center;
      padding: 20px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
    }

    .header img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      margin-bottom: 5px;
    }

    .container {
      width: 500px;
      background: #fff;
      margin: 30px auto;
      padding: 25px 30px;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    h3 {
      text-align: center;
      color: #2e8b57;
      border-bottom: 2px solid #cceccd;
      padding-bottom: 6px;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
      color: #333;
    }

    select, input[type="text"], input[type="number"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 5px;
      transition: 0.2s;
    }

    select:focus, input:focus {
      border-color: #2e8b57;
      box-shadow: 0 0 4px #a5e1b4;
      outline: none;
    }

    input[type="submit"], .print-btn {
      width: 100%;
      background-color: #2e8b57;
      color: white;
      border: none;
      border-radius: 6px;
      padding: 10px;
      margin-top: 18px;
      cursor: pointer;
      font-size: 15px;
      transition: 0.3s;
    }

    input[type="submit"]:hover, .print-btn:hover {
      background-color: #256d46;
    }

    .hasil {
      margin-top: 25px;
      background-color: #f4fff5;
      border-left: 5px solid #2e8b57;
      padding: 15px;
      border-radius: 8px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 8px;
    }

    table, th, td {
      border: 1px solid #ccc;
    }

    th, td {
      padding: 6px;
      text-align: center;
    }

    th {
      background-color: #d9f7de;
      color: #2e8b57;
    }

    .footer {
      text-align: center;
      color: #666;
      font-size: 13px;
      margin-top: 20px;
    }

    .print-btn {
      background-color: #3b9a58;
      margin-top: 10px;
    }

    @media print {
      .print-btn, input[type="submit"] {
        display: none;
      }
      body {
        background: white;
      }
      .container {
        box-shadow: none;
      }
    }
  </style>
</head>
<body>

  <div class="header">
    <img src="STM.png" alt="Logo Sekolah">
    <h2>SMKN 3 PALU</h2>
    <p>Sistem Penilaian Akademik Siswa</p>
  </div>

  <div class="container">
    <h3>Form Penilaian Akademik</h3>

    <form method="post">
      <!-- Pilih Nama -->
      <label>Nama Siswa</label>
      <select name="nama" required>
        <option value="">-- Pilih Nama --</option>
        <option value="Davansyah">Davansyah</option>
        <option value="Idrus">Idrus</option>
        <option value="Anto">Anto</option>
        <option value="Fadlan">Fadlan</option>
        <option value="Kevin">Kevin</option>
      </select>

      <!-- Input NISN -->
      <label>NISN</label>
      <input type="text" name="nisn" placeholder="Masukkan NISN siswa..." required>

      <?php
      // daftar mapel
      $mapel = ["Bahasa Indonesia", "Matematika", "Bahasa Inggris", "PKN", "Produktif (Keahlian)"];

      foreach ($mapel as $m) {
        echo "
        <label>$m</label>
        <input type='number' name='nilai[]' placeholder='Masukkan nilai $m' min='0' max='100' required>
        ";
      }
      ?>

      <input type="submit" name="proses" value="Hitung Rata-rata">
    </form>

    <?php
    if (isset($_POST['proses'])) {
      $nama = $_POST['nama'];
      $nisn = $_POST['nisn'];
      $nilai = $_POST['nilai'];
      $tanggal = date("d F Y");

      // fungsi konversi nilai ke huruf
      function huruf($n) {
        if ($n >= 85) return "A (Sangat Baik)";
        elseif ($n >= 70) return "B (Baik)";
        elseif ($n >= 60) return "C (Cukup)";
        else return "D (Kurang)";
      }

      $rata = array_sum($nilai) / count($nilai);
      $status = ($rata >= 70) ? "Lulus" : "Tidak Lulus";

      echo "<div class='hasil'>";
      echo "<b>Tanggal:</b> $tanggal<br>";
      echo "<b>Nama:</b> $nama<br>";
      echo "<b>NISN:</b> $nisn<br><br>";
      echo "<b>Hasil Nilai:</b>";
      echo "<table>";
      echo "<tr><th>Mata Pelajaran</th><th>Nilai</th><th>Huruf</th></tr>";

      for ($i = 0; $i < count($mapel); $i++) {
        $nHuruf = huruf($nilai[$i]);
        echo "<tr>
                <td>{$mapel[$i]}</td>
                <td>{$nilai[$i]}</td>
                <td>$nHuruf</td>
              </tr>";
      }

      echo "</table><br>";
      echo "<b>Rata-rata:</b> " . number_format($rata, 2) . "<br>";
      echo "<b>Status:</b> $status";
      echo "<br><button class='print-btn' onclick='window.print()'>Cetak Nilai (PDF)</button>";
      echo "</div>";
    }
    ?>
  </div>

  <div class="footer">
    © 2025 SMKN 3 Palu | Sistem Nilai Akademik Digital
  </div>

</body>
</html>