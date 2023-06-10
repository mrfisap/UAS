<?php
//agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
include('../koneksi.php');
session_start();
if ($_SESSION['login'] != true) {
    header("location:../index.php?pesan=belum_login");
}
?>
<!DOCTYPE html>
<html>

<head>

    <title>CRUD_UAS_RAFFI</title>
    <style type="text/css">
        * {
            font-family: "Trebuchet MS";

        }

        h1 {
            text-transform: uppercase;
            color: grey;
            padding: 20px;
            text-align: center;
            text-shadow: 1px 1px 1px #fe7339;
            
        }

        table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            width: 70%;
            margin: 10px auto 10px auto;
        }

        table thead th {
            background-color: grey;
            border: solid 1px #DDEEEE;
            color: #fff;
            padding: 10px;
            text-align: left;
            text-shadow: 1px 1px 1px #ff9800;
            text-decoration: none;
        }

        table tbody td {
            border: solid 1px #DDEEEE;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
        }

        a {
            background-color: grey;
            color: #fff;
            padding: 12px;
            text-decoration: none;
            font-size: 12px;
        }

        .add-produk {
            background-color: #ff9800;

        }

        .navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        .navbar li {
            float: left;
        }

        .navbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar li a:hover {
            background-color: #111;
        }
    </style>
</head>

<body>
        <h1>Data Produk</h1>    
    <ul class="navbar">
        <li><a class="active" href="logout.php">Logout</a></li>
        <li><a href="report-pdf.php" target="_blank">Print</a></li>
        <li><a href="report-excel.php" target="_blank">Excel</a></li>
        <li><a href="tambah_produk.php" class="add-produk">+ &nbsp; Tambah Produk</a></li>
        <form action="index.php" method="get">
            <li>
                <input type="text" name="cari" style="margin-top:5px; padding: 5px; width: 500%; border-radius: 15px">
            </li>
        </form>
        </li>
            <div class="cari" style="margin-top: 10px; text-align: right; margin-right: 20px;">
                <input type="submit" value="Cari"> &nbsp;
                <a href="index.php">Reset</a>
            </div>
        </li>
    </ul>
    <center>
    </center>
    

    <!-- <div class="card">
            <img src="../gambar/Biker.jpg" alt="Denim Jeans" style="width:100%">
            <h1>SHOCK OHLIN</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans..</p>
            <p><button>Add to Cart</button></p>
        </div> -->

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Produk</th>
                <th>Dekripsi</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
            if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
                $query = "SELECT * FROM produk WHERE deskripsi like '%" . $cari . "%'";
            } else {
                $query = "SELECT * FROM produk ORDER BY id ASC ";
            }
            $result = mysqli_query($koneksi, $query);
            //mengecek apakah ada error ketika menjalankan query
            if (!$result) {
                die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            }

            //buat perulangan untuk element tabel dari data mahasiswa
            $no = 1; //variabel untuk membuat nomor urut
            // hasil query akan disimpan dalam variabel $data dalam bentuk array
            // kemudian dicetak dengan perulangan while
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td> <?= $no; ?> </td>
                    <td>
                        <?= $row['nama_produk']; ?>
                    </td>
                    <td> <?= substr($row['deskripsi'], 0, 20); ?>... </td>
                    <td>Rp <?= number_format($row['harga_beli'], 0, ',', '.'); ?> </td>
                    <td>Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?> </td>
                    <td style="text-align: center;">
                        <img src="../gambar/<?= $row['gambar_produk']; ?>" style="width: 120px;">
                    </td>
                    <td>
                        <a href="edit_produk.php?id=<?= $row['id']; ?>">Edit </a> | <a
                            href="proses_hapus.php?id=<?= $row['id']; ?>"
                            onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus </a>
                    </td>
                </tr>
                <?php
                $no++; //untuk nomor urut terus bertambah 1
            }
            ?>
        </tbody>
    </table>
</body>

</html>