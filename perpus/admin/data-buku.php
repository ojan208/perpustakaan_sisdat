<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include 'insert/modalInsBuku.php'?>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bukuModal">
        + Buku
    </button>
    <div>  
    <table class="table table-secondary table-striped my-3">
        <thead>
            <tr>
                <th>Cover</th>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>jumlah</th>
                <th>genre</th>
                <th>lokasi</th>
                <th>last updated by:</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $bukuArr = mysqli_query($conn, "SELECT buku.*, rak.nama_rak AS lokasi, petugas.nama AS petugas
                                            FROM buku
                                            JOIN rak ON rak.id = buku.id_rak
                                            JOIN petugas ON petugas.id = buku.id_petugas");
            if(mysqli_num_rows($bukuArr) > 0)
            while($dataBuku = mysqli_fetch_array($bukuArr))
            {{
            ?>
            <tr>
                <td class="sampul"><img src="../sampul/<?php echo $dataBuku['cover']?>" alt="" width="56" height="auto"></td>
                <td><?php echo $dataBuku['id']?></td>
                <td><?php echo $dataBuku['judul']?></td>
                <td><?php echo $dataBuku['penulis']?></td>
                <td><?php echo $dataBuku['penerbit']?></td>
                <td><?php echo $dataBuku['jumlah']?></td>
                <td><?php echo $dataBuku['genre']?></td>
                <td><?php echo $dataBuku['lokasi']?></td>
                <td><?php echo $dataBuku['petugas']?></td>
                <td>edit del</td>
            </tr>
            <?php }} else {?>
                <td colspan="10">Tidak Ada data</td>
            <?php }?>
        </tbody>
    </table>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>