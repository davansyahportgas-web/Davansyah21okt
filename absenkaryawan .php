<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Kehadiran Karyawan</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #eef3fa;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #1e90ff;
      color: white;
      text-align: center;
      padding: 20px 0;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    h1 {
      margin: 0;
    }

    .container {
      width: 90%;
      max-width: 1000px;
      margin: 40px auto;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 20px 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: #1e90ff;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    select {
      padding: 5px 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .btn {
      background-color: #1e90ff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      display: block;
      margin: 25px auto;
      font-size: 16px;
    }

    .btn:hover {
      background-color: #0b73d9;
    }

    .tanggal {
      text-align: right;
      color: #555;
      font-size: 15px;
    }

    h2 {
      text-align: center;
      margin-top: 40px;
      color: #2c3e50;
    }
  </style>
</head>
<body>

<header>
  <h1>Data Kehadiran Karyawan</h1>
</header>

<div class="container">
  <div class="tanggal">
    <?php
      date_default_timezone_set('Asia/Jakarta');
      $tanggal = date("l, d F Y");
      echo "<strong>Tanggal: </strong>" . $tanggal;
    ?>
  </div>

  <form method="post">
    <table>
      <tr>
        <th>No</th>
        <th>Nama Karyawan</th>
        <th>NISN</th>
        <th>Alamat</th>
        <th>Status Kehadiran</th>
      </tr>

      <?php
        // Data karyawan (seolah dari database)
        $karyawan = [
          ["nama" => "Satrio", "nisn" => "20231001", "alamat" => "Jl. Sidera No. 12, Sigi"],
          ["nama" => "Kevin", "nisn" => "20231002", "alamat" => "Jl. Manimbaya 4, Palu"],
          ["nama" => "Anto", "nisn" => "20231003", "alamat" => "Jl. Bali No. 9, Palu"],
          ["nama" => "Fadlan", "nisn" => "20231004", "alamat" => "Jl. Kancil No. 5, Palu"],
          ["nama" => "Idrus", "nisn" => "20231005", "alamat" => "Jl. Nuri No. 18, Palu"]
        ];

        $statusList = $_POST['status'] ?? [];

        for ($i = 0; $i < count($karyawan); $i++) {
          $no = $i + 1;
          $status = isset($statusList[$i]) ? $statusList[$i] : "Hadir";

          echo "<tr>
                  <td>$no</td>
                  <td>{$karyawan[$i]['nama']}</td>
                  <td>{$karyawan[$i]['nisn']}</td>
                  <td>{$karyawan[$i]['alamat']}</td>
                  <td>
                    <select name='status[$i]'>
                      <option value='Hadir' " . ($status == "Hadir" ? "selected" : "") . ">Hadir</option>
                      <option value='Izin' " . ($status == "Izin" ? "selected" : "") . ">Izin</option>
                      <option value='Alpa' " . ($status == "Alpa" ? "selected" : "") . ">Alpa</option>
                    </select>
                  </td>
                </tr>";
        }
      ?>
    </table>

    <button type="submit" class="btn">Simpan Kehadiran</button>
  </form>

  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      echo "<h2>Rekap Kehadiran Hari Ini</h2>";
      echo "<table>";
      echo "<tr><th>No</th><th>Nama</th><th>NISN</th><th>Status</th></tr>";

      for ($i = 0; $i < count($karyawan); $i++) {
        $no = $i + 1;
        $st = $statusList[$i];
        echo "<tr>
                <td>$no</td>
                <td>{$karyawan[$i]['nama']}</td>
                <td>{$karyawan[$i]['nisn']}</td>
                <td>$st</td>
              </tr>";
      }
      echo "</table>";
    }
  ?>
</div>

</body>
</html>