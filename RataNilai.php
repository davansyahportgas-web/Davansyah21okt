<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Nilai Siswa - SMKN 3 Palu</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #f0f8f3;
      margin: 0;
      padding: 0;
    }

    .header {
      background: linear-gradient(135deg, #2e8b57, #3eb26a);
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

    .header h2 {
      margin: 5px 0;
    }

    .container {
      width: 460px;
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
      padding-bottom: 5px;
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
      color: #333;
    }

    input[type="number"], select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 4px;
      transition: 0.2s;
    }

    input[type="number"]:focus, select:focus {
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
      margin-top: 15px;
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
      background-color: #388e3c;
      margin-top: 10px;
    }

    .print-btn:active {
      transform: scale(0.98);
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
    <h3>Perhitungan Rata-rata Nilai Siswa</h3>
    <form method="post">
      <label>Nama Siswa</label>
      <select name="nama" required>
        <option value="">-- Pilih Nama Siswa --</option>
        <option value="Davansyah">Davansyah</option>
        <option value="Idrus">Idrus</option>
        <option value="Anto">Anto</option>
        <option value="Fadlan">Fadlan</option>
        <option value="Kevin">Kevin</option>
      </select>

      <label>Bahasa Indonesia</label>
      <input type="number" name="n1" min="0" max="100" required>

      <label>Matematika</label>
      <input type="number" name="n2" min="0" max="100" required>

      <label>Bahasa Inggris</label>
      <input type="number" name="n3" min="0" max="100" required>

      <label>PKN</label>
      <input type="number" name="n4" min="0" max="100" required>

      <label>Produktif (Keahlian)</label>
      <input type="number" name="n5" min="0" max="100" required>

      <input type="submit" name="hitung" value="Hitung Rata-rata">
    </form>

    <?php
    if (isset($_POST['hitung'])) {
      $nama = $_POST['nama'];
      $mapel = ["Bahasa Indonesia", "Matematika", "Bahasa Inggris", "PKN", "Produktif (Keahlian)"];
      $nilai = [
        $_POST['n1'],
        $_POST['n2'],
        $_POST['n3'],
        $_POST['n4'],
        $_POST['n5']
      ];

      $rata = array_sum($nilai) / count($nilai);
      $ket = $rata >= 70 ? "Lulus" : "Tidak Lulus";

      echo "<div class='hasil'>";
      echo "<b>Nama Siswa:</b> $nama<br><br>";
      echo "<b>Nilai Mata Pelajaran:</b>";
      echo "<table>";
      echo "<tr><th>Mata Pelajaran</th><th>Nilai</th></tr>";
      for ($i = 0; $i < count($mapel); $i++) {
        echo "<tr><td>{$mapel[$i]}</td><td>{$nilai[$i]}</td></tr>";
      }
      echo "</table>";
      echo "<br><b>Rata-rata:</b> " . number_format($rata, 2) . "<br>";
      echo "<b>Keterangan:</b> $ket";
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