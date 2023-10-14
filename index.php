<?php 
include_once('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form class="row" method="POST" action="" name="myForm">
        <?php 
        $isi = '';
        $tgl_awal = '';
        $tgl_akhir = '';
        if (isset($_GET['id'])){
            $id=$_GET['id'];
            $queri1 = mysqli_query($mysqli, "SELECT * FROM kegiatan WHERE id='$id'");
            while ($row1 = mysqli_fetch_array($queri1)){
                $isi = $row1['isi'];
                $tgl_awal = $row1['tgl_awal'];
                $tgl_akhir = $row1['tgl_akhir'];
            }?>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <?php 
        }?>
        <div class="row">
            <div class="col">
                <label for="cont" class="visually-hidden">Kegiatan</label>
                <input type="text" class="form-control" name="newCont" placeholder="Kegiatan" value="<?php echo $isi ?>">
            </div>
            <div class="col">
                <label for="EDate" class="visually-hidden">Tanggal Awal</label>
                <input type="date" class="form-control" name="newEDate" placeholder="Tanggal Awal" value="<?php echo $tgl_awal ?>">
            </div>
            <div class="col">
                <label for="LDate" class="visually-hidden">Tanggal Akhir</label>
                <input type="date" class="form-control" name="newLDate" placeholder="Tanggal Akhir" value="<?php echo $tgl_akhir ?>">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary rounded-pill px-3" name="save">Simpan</button>
            </div>
        </div>
    </form>
    <tbody>
        <?php 
        $queri2 = mysqli_query($mysqli, "SELECT * FROM kegiatan ORDER BY status, tgl_awal");
        $i= 1;
        while ($row2 = mysqli_fetch_array($queri2)){?>
            <tr>
                <th scope="row"><?php echo $i++ ?></th>
                <td><?php echo $row2['isi'] ?></td>
                <td><?php echo $row2['tgl_awal'] ?></td>
                <td><?php echo $row2['tgl_akhir'] ?></td>
                <td>
                    <?php
                    if ($row2['status'] =='1'){?>
                        <a class="btn btn-success rounded-pill px-3" type="button" href="index.php?id<?php echo $row2['id']?>&aksi=ubah_status&status=0">Sudah</a>
                    <?php } else{?>
                        <a class="btn btn-warning rounded-pill px-3" type="button" href="index.php?id<?php echo $row2['id']?>&aksi=ubah_status&status=1">Belum</a>
                    <?php } ?>
                </td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" href="index.php?id=<?php echo $row2['id'] ?>">Ubah</a>
                    <a class="btn btn-danger rounded-pill px-3" href="index.php?id=<?php echo $row2['id'] ?>&aksi=hapus">Hapus</a>
                </td>
            </tr>
        <?php } 
        if (isset($_POST['save'])){
            $id_baru = $_POST['id'];
            $isi_baru = $_POST['newCont'];
            $tgl_awal_baru = $_POST['newEDate'];
            $tgl_akhir_baru = $_POST['newLDate'];
            if (isset($id_baru)){
                if (isset($isi_baru)){
                    if (isset($tgl_awal_baru)){
                        if (isset($tgl_akhir_baru)){
                            $queri3 = mysqli_query($mysqli, "UPDATE kegiatan SET 
                                isi='$isi_baru',
                                tgl_awal='$tgl_awal_baru',
                                tgl_akhir='$tgl_akhir_baru' WHERE id='$id_baru'");
                        } else{
                            echo "<script>alert('Silakan lengkapi bagian Tanggal Akhir!')</script>";
                        }
                    } else{
                        echo "<script>alert('Silakan lengkapi bagian Tanggal Akhir!')</script>";
                    } 
                } else{
                    echo "<script>alert('Silakan lengkapi bagian Tanggal Akhir!')</script>";
                }           
            } else {
                $queri4 = mysqli_query($mysqli, "INSERT INTO kegiatan(isi,tgl_awal,tgl_akhir,status) VALUES(
                    '$isi_baru','$tgl_awal_baru','$tgl_akhir_baru','0')");
            } 
            header("Location: index.php");
        }
        if (isset($_GET['aksi'])){
            $aksi=$_GET['aksi'];
            $status = $_GET['status'];
            $id=$_GET['id'];
            if ($aksi == 'hapus'){
                $queri5 = mysqli_query($mysqli, "DELETE FROM kegiatan WHERE id='$id'");
            } else  if ($aksi == 'ubah_status'){
                $queri4 = mysqli_query($mysqli, "UPDATE kegiatan SET status='$status' WHERE id='$id'");
            } 
            header("Location: index.php");
        }
        ?>
    </tbody>
</body>
</html>