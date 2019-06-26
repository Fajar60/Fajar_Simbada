<?php
    $koneksi = mysqli_connect("localhost","root","","dokter")
?>

<h1>Hasil Pemeriksaan</h1>
<?php
    $dataEdit[1]="";
    $dataEdit[2]="";
    $tombol="registrasi";
    if(isset($_GET['aksi'])) {
        if($_GET['aksi']=='edit') {
            $sqlEdit="SELECT * FROM pasien WHERE id='$_GET[id]'";
            $cekEdit= mysqli_query($koneksi,$sqlEdit);
            $dataEdit=mysqli_fetch_array($cekEdit);

            $tombol="edit";
        }
    }
?>
<form action="" method="post">
    Nama : <input type="text" name="nama" value="<?=$dataEdit[1]?>"><br><br>
    Keterangan : <input type="text" name="keterangan" value="<?=$dataEdit[2]?>"><br><br>
    <input type="submit" value="<?=$tombol?>" name="<?=$tombol?>" >
</form>
</form>

<table border="1">
    <thead>
        <th>Nama</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </thead>
    <tbody>
    <?php
            $sqlView = "SELECT * FROM `pasien`";
            $cekView = mysqli_query($koneksi, $sqlView);
            
            $nomor = 1;
            while ($data = mysqli_fetch_array($cekView)) {

        ?>
        <tr>
            <td><?=$nomor?></td>
            <td><?=$data[1]?></td>
            <td><?=$data[2]?></td>
            <td>>
                <a href="index.php?nomor=<?=$data[0]?>&aksi=edit">Edit</a>
                <a href="index.php?nomor=<?=$data[0]?>&aksi=delete">Delete</a>
            </td>
        </tr>

        <?php
            $nomor=$nomor+1;
            }
        ?>

    </tbody>
    <tfoot>
        
    </tfoot>
</table>

<?php
    if(isset($_POST['registrasi'])) {
        $sql = "INSERT INTO `pasien` (`nama`, `keterangan`) VALUES ('$_POST[nama]', '$_POST[keterangan]')";
        $cekInput = mysqli_query($koneksi, $sql);
        if($cekInput) {
            echo "<script> window.location = 'riskyy.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }
    else if(isset($_POST['edit'])) {
        $sqlEdit = "UPDATE `pasien` SET `nama` = '$_POST[nama]', `keterangan` = '$_POST[keterangan]' WHERE `pasien`.`nomor` = '$_GET[nomor]';";
        $cekEdit = mysqli_query($koneksi, $sqlEdit);

        if($cekEdit) {
            echo "<script> window.location = 'riskyy.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }

    if(isset($_GET['aksi'])) {
        if($_GET['aksi']=='delete') {
            $sqlDelete = "DELETE FROM `pasien` WHERE `pasien`.`id` = '$_GET[id]'  ";
            $cekDelete = mysqli_query($koneksi, $sqlDelete);

            if($cekDelete) {
                echo "<script> window.location = 'riskyy.php'</script>";
            } else {    
                echo "Data belum terhapus";
            }
        }
    }

    
?>