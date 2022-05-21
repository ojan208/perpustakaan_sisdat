<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include 'insert/modalInsAng.php'?>;

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#angModal">
        Daftar Anggota
    </button>

    <div>
        <table class="table table-secondary table-striped my-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../db.php';
                $angArr = mysqli_query($conn, "SELECT * from anggota");
                if(mysqli_num_rows($angArr) > 0)
                while($dataAnggota = mysqli_fetch_array($angArr))
                {{
                ?>
                <tr>
                    <td><?php echo $dataAnggota['id']?></td>
                    <td><?php echo $dataAnggota['nama']?></td>
                    <td><?php echo $dataAnggota['no_telpon']?></td>
                    <td>edit del</td>
                </tr>
                <?php }} else {?>
                    <td colspan="10">Tidak Ada data</td>
                <?php }?>
            </tbody>
        </table>
    </div>
</body>
</html>