<?php
$koneksi=mysqli_connect("localhost","root","","risky_hospital")
?>
<h3>RISKY HOSPITAL</h3>

<?php
    $dataEdit[1]="";
    $dataEdit[2]="";
    $dataEdit[3]="";
    $tombol="registrasi";
    if(isset($_GET['aksi'])) {
        if($_GET['aksi']=='edit') {
            $edit="SELECT * FROM Identitas WHERE id='$_GET[id]'";
            $cekEdit= mysqli_query($koneksi,$edit);
            $dataEdit=mysqli_fetch_array($cekEdit);

            $tombol="edit";
        }
    }
?>
<form action="" method="post">
    <table>
        
        <tr>
            <td>Nama_pasien</td>
            <td>:</td> 
            <td><input type="text" name="Nama_pasien" value="<?=$dataEdit[1]?>"></td>
        </tr>
        <tr>
            <td>Penyakit_pasien</td>
            <td>:</td> 
            <td><input type="text" name="Jenis_penyakit" value="<?=$dataEdit[2]?>"></td>
        </tr>
        <tr>
            <td>Obat_pasien</td>
            <td>:</td> 
            <td><input type="text" name="Obat_pasien" value="<?=$dataEdit[3]?>"></td>
        </tr>
     
    </table>
    <tr><input type="submit" value="<?=$tombol?>" name="<?=$tombol?>"></tr>
</form>

<table border="1" >
<thead>
    <th>NOMOR</th>
    <th>Nama Pasien</th>
    <th>Penyakit Pasien</th>
    <th>Obat Pasien</th>
    <th>Aksi</th>
</thead>
<tbody>

<?php
    $sqlView = "SELECT * FROM `Identitas`";
    $cekView = mysqli_query($koneksi, $sqlView);
        
    $nomor = 1;
    while ($data = mysqli_fetch_array($cekView)) {
?>
    <tr>
        <td><?=$nomor?></td>
        <td><?=$data[1]?></td>
        <td><?=$data[2]?></td>
        <td><?=$data[3]?></td>
        <td>
            <a href="pemrograman.php?id=<?=$data[0]?>&aksi=edit">Edit</a>
        </td>
    </tr>

<?php
    $nomor=$nomor+1;
    }
?>

</tbody>
</table>

<?php
    if(isset($_POST['registrasi'])) 
    {
        $sql = "INSERT INTO `Identitas` (`Nama_pasien`,`Jenis_penyakit`,`Obat_pasien`) VALUES ('$_POST[Nama_pasien]', '$_POST[Jenis_penyakit]', '$_POST[Obat_pasien]')";
        $cekInput = mysqli_query($koneksi, $sql);

        if($cekInput) {
            echo "<script> window.location = 'simbada.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }
    else if (isset($_POST['edit']))
    {
        $edit = "UPDATE `Identitas` SET `Nama_pasien` = '$_POST[Nama_pasien]', `Jenis_penyakit` = '$_POST[Jenis_penyakit]', `Obat_pasien` = '$_POST[Obat_pasien]';";
        $cekEdit = mysqli_query($koneksi, $edit);  

        if($cekEdit) {
            echo "<script> window.location = 'simbada.php'</script>";
        } else {    
            echo "Data belum masuk";
        }
    }
?>