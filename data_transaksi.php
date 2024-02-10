<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="data_transaksi1.css">
    <title>TOMZKY STORE</title>
</head>

<body align="center">
    <header>
        <h1>TOMZKY STORE</h1>

        <a href="home.php" class="back-btn">Back</a>
    </header>
    <form action="" method="post">
        <table border="1" align="center">
            <td width="150">Alamat</td>
            <td>:</td>
            <td><input type="text" name="alamat_pembeli" required></td>
            <tr>
                <td width="150">Nama Pembeli</td>
                <td>:</td>
                <td><input type="text" name="nama_pembeli" required></td>
            </tr>
            <tr>
                <td>Merk Sepatu</td>
                <td>:</td>
                <td><input type="text" name="merk_sepatu" required></td>
            </tr>
            <tr>
                <td>Ukuran Sepatu</td>
                <td>:</td>
                <td><input type="text" name="ukuran_sepatu" required></td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><input type="text" name="jml_beli" required></td>
            </tr>
            <tr>
                <td>Aksi</td>
                <td>:</td>
                <td><input type="submit" name="save" value="Simpan">
                    <input type="submit" name="update" value="Update" style="display: none;">
                </td>
            </tr>
        </table>
    </form>
    <footer>
        <p>&copy; 2023 TOMZKY STORE. All rights reserved.</p>
    </footer>

</body>

</html>

<?php
include "koneksi.php";

//menyimpan data ke database
if (isset($_POST['save'])) {
    $alamat_pembeli = $_POST['alamat_pembeli'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $merk_sepatu = $_POST['merk_sepatu'];
    $ukuran_sepatu = $_POST['ukuran_sepatu'];
    $jml_beli = $_POST['jml_beli'];

    $query = "INSERT INTO data_transaksi (alamat_pembeli, nama_pembeli, merk_sepatu, ukuran_sepatu, jml_beli) VALUES ('$alamat_pembeli', '$nama_pembeli', '$merk_sepatu', '$ukuran_sepatu', '$jml_beli')";
    $result = mysqli_query($koneksi, $query);

    //mengecek apakah data berhasil disimpan atau tidak akan muncul di table
    if ($result) {
        //tampilkan data pada tabel
        echo "<table border='1' align='center'>
            <tr>
                <td>No</td>
                <td>Nama Pembeli</td>
                <td>Merk Sepatu</td>
                <td>Ukuran Sepatu</td>
                <td>Jumlah</td>
                <td>Aksi</td>

            </tr>";
        $no = 1;
        $query = "SELECT * FROM data_transaksi";
        $result = mysqli_query($koneksi, $query);
        while ($data = mysqli_fetch_array($result)) {
            echo "<tr>
                <td>" . $no . "</td>
                <td>" . $data['nama_pembeli'] . "</td>
                <td>" . $data['merk_sepatu'] . "</td>
                <td>" . $data['ukuran_sepatu'] . "</td>
                <td>" . $data['jml_beli'] . "</td>
                <td><form method='post'>
                    <input type='hidden' name='alamat_pembeli' value='" . $data['alamat_pembeli'] . "'>
                    <input type='submit' name='edit' value='Edit'>
                    <input type='submit' name='delete' value='Hapus'>
                    </form>
                </td>
                </tr>";
            $no++;
        }
        echo "</table>";
    }
}



//menghapus data 1 per 1 dari database
if (isset($_POST['delete'])) {
    $alamat_pembeli = $_POST['alamat_pembeli'];
    $query = "DELETE FROM data_transaksi WHERE alamat_pembeli='$alamat_pembeli'";
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        echo "<table border='1' align='center'>
            <tr>
                <td>No</td>
                <td>Nama Pembeli</td>
                <td>Merk Sepatu</td>
                <td>Ukuran Sepatu</td>
                <td>Jumlah</td>
                <td>Aksi</td>

            </tr>";
        $no = 1;
        $query = "SELECT * FROM data_transaksi";
        $result = mysqli_query($koneksi, $query);
        while ($data = mysqli_fetch_array($result)) {
            echo "<tr>
                <td>" . $no . "</td>
                <td>" . $data['nama_pembeli'] . "</td>
                <td>" . $data['merk_sepatu'] . "</td>
                <td>" . $data['ukuran_sepatu'] . "</td>
                <td>" . $data['jml_beli'] . "</td>
                <td><form method='post'>
                    <input type='hidden' name='alamat_pembeli' value='" . $data['alamat_pembeli'] . "'>
                    <input type='submit' name='edit' value='Edit'>
                    <input type='submit' name='delete' value='Hapus'>
                    </form>
                </td>
                </tr>";
            $no++;
        }
        echo "</table>";
    }
}

//memuat data yang akan diedit ke dalam form
if (isset($_POST['edit'])) {
    $alamat_pembeli = $_POST['alamat_pembeli'];
    $query = "SELECT * FROM data_transaksi WHERE alamat_pembeli='$alamat_pembeli'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_array($result);
}
?>
<script>
    document.getElementsByName("alamat_pembeli")[0].value = "<?php echo $data['alamat_pembeli']; ?>";
    document.getElementsByName("nama_pembeli")[0].value = "<?php echo $data['nama_pembeli']; ?>";
    document.getElementsByName("merk_sepatu")[0].value = "<?php echo $data['merk_sepatu']; ?>";
    document.getElementsByName("ukuran_sepatu")[0].value = "<?php echo $data['ukuran_sepatu']; ?>";
    document.getElementsByName("jml_beli")[0].value = "<?php echo $data['jml_beli']; ?>";
    document.getElementsByName("save")[0].style.display = "none";
    document.getElementsByName("update")[0].style.display = "inline";
</script>



<?php


//memperbarui data yang telah diedit
if (isset($_POST['update'])) {
    $alamat_pembeli = $_POST['alamat_pembeli'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $merk_sepatu = $_POST['merk_sepatu'];
    $ukuran_sepatu = $_POST['ukuran_sepatu'];
    $jml_beli = $_POST['jml_beli'];

    $query = "UPDATE data_transaksi SET nama_pembeli='$nama_pembeli', merk_sepatu='$merk_sepatu', ukuran_sepatu='$ukuran_sepatu', jml_beli='$jml_beli' WHERE alamat_pembeli='$alamat_pembeli'";
    $result = mysqli_query($koneksi, $query);

    //mengecek apakah data berhasil disimpan atau tidak akan muncul di table
    if ($result) {
        //tampilkan data pada tabel
        echo "<table border='1' align='center'>
            <tr>
                <td>No</td>
                <td>Nama Pembeli</td>
                <td>Merk Sepatu</td>
                <td>Ukuran Sepatu</td>
                <td>Jumlah</td>
                <td>Aksi</td>

            </tr>";
        $no = 1;
        $query = "SELECT * FROM data_transaksi";
        $result = mysqli_query($koneksi, $query);
        while ($data = mysqli_fetch_array($result)) {
            echo "<tr>
                <td>" . $no . "</td>
                <td>" . $data['nama_pembeli'] . "</td>
                <td>" . $data['merk_sepatu'] . "</td>
                <td>" . $data['ukuran_sepatu'] . "</td>
                <td>" . $data['jml_beli'] . "</td>
                <td><form method='post'>
                    <input type='hidden' name='alamat_pembeli' value='" . $data['alamat_pembeli'] . "'>
                    <input type='submit' name='edit' value='Edit'>
                    <input type='submit' name='delete' value='Hapus'>
                    </form>
                </td>
                </tr>";
            $no++;
        }
        echo "</table>";
    }
}


?>