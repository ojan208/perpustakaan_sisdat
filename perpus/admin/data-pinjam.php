<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include 'insert/modalInsPinjam.php'?>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamModal">
        + Pinjam
    </button>
    <div>
        <table class="table table-secondary table-striped my-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Buku yang dipinjam</th>
                    <th>Anggota yang Meminjam</th>
                    <th>Petugas</th>
                    <th>Tanggal Pinjam</th>
                    <th>Deadline</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../db.php';
                $pinjamArr = mysqli_query($conn, "SELECT peminjaman.id, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, 
                                        buku.judul, petugas.nama AS kreditor, anggota.nama AS peminjam
                                        FROM peminjaman
                                        JOIN buku ON buku.id = peminjaman.id_buku
                                        JOIN petugas ON petugas.id = peminjaman.id_petugas
                                        JOIN anggota ON anggota.id = peminjaman.id_anggota");
                if(mysqli_num_rows($pinjamArr) > 0)
                    while($dataPinjam = mysqli_fetch_array($pinjamArr))
                    {{
                ?>
                <tr>
                    <td><?php echo $dataPinjam['id']?></td>
                    <td><?php echo $dataPinjam['judul']?></td>
                    <td><?php echo $dataPinjam['peminjam']?></td>
                    <td><?php echo $dataPinjam['kreditor']?></td>
                    <td><?php echo $dataPinjam['tgl_pinjam']?></td>
                    <td><?php echo $dataPinjam['tgl_kembali']?></td>
                    <td>edit del</td>
                </tr>
                <?php }} else {
                ?>
                <td colspan="7">Tidak Ada data</td>
                <?php }?>
            </tbody>
        </table>
        <!-- <table border="1" cellspacing="0" class="tabel">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Buku yang dipinjam</th>
                    <th>Anggota yang Meminjam</th>
                    <th>Petugas</th>
                    <th>Tanggal Pinjam</th>
                    <th>Deadline</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../db.php';
                $pinjamArr = mysqli_query($conn, "SELECT peminjaman.id, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, 
                                        buku.judul, petugas.nama AS kreditor, anggota.nama AS peminjam
                                        FROM peminjaman
                                        JOIN buku ON buku.id = peminjaman.id_buku
                                        JOIN petugas ON petugas.id = peminjaman.id_petugas
                                        JOIN anggota ON anggota.id = peminjaman.id_anggota");
                if(mysqli_num_rows($pinjamArr) > 0)
                    while($dataPinjam = mysqli_fetch_array($pinjamArr))
                    {{
                ?>
                <tr>
                    <td><?php echo $dataPinjam['id']?></td>
                    <td><?php echo $dataPinjam['judul']?></td>
                    <td><?php echo $dataPinjam['peminjam']?></td>
                    <td><?php echo $dataPinjam['kreditor']?></td>
                    <td><?php echo $dataPinjam['tgl_pinjam']?></td>
                    <td><?php echo $dataPinjam['tgl_kembali']?></td>
                    <td>edit del</td>
                </tr>
                <?php }} else {
                ?>
                <td colspan="7">Tidak Ada data</td>
                <?php }?>
            </tbody>
        </table> -->
    </div>
</body>
</html>