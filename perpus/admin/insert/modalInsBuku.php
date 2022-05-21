<!-- Modal  -->
<div class="modal fade" id="bukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Menambah Buku Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Tubuh Modal  -->
            <?php
                // Variabel buat tambah data
                include '../db.php';
                $genreEnum = mysqli_query($conn, "SELECT SUBSTRING(COLUMN_TYPE,5) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'perpusa' AND TABLE_NAME = 'buku' AND COLUMN_NAME = 'genre'");
                $namaGenreEnum = $genreEnum->fetch_array()[0] ?? '';
                $namaGenreEnum = str_replace("'", "", $namaGenreEnum);
                $namaGenreEnum = substr($namaGenreEnum, 1, -1);
                $namaGenreArr = explode(',', $namaGenreEnum);

                $rakArr = mysqli_query($conn, "SELECT * FROM rak");
            ?>
            <form action="insert/insertBuku.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Cover Buku</label>
                    <br>
                    <input type="file" name="sampul" class="input-control">
                </div>
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="Judul"
                    placeholder="Masukan Judul Buku">
                </div>

                <div class="mb-3">
                    <label>Penulis</label>
                    <input type="text" class="form-control" name="Penulis"
                    placeholder="Masukan Penulis Buku">
                </div>

                <div class="mb-3">
                    <label>Penerbit</label>
                    <input type="text" class="form-control" name="Penerbit"
                    placeholder="Masukan Penerbit Buku">
                </div>

                <div class="mb-3">
                    <label>Genre</label>
                    <select name="Genre" value="">
                        <option value="0">--Pilih--</option>
                        <?php
                        foreach($namaGenreArr as $namaGenre)
                        {?>
                        <option value="<?php echo $namaGenre?>"><?php echo $namaGenre?></option>
                        <?php }?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Lokasi</label>
                    <select name="Lokasi">
                        <option value="0">--Pilih--</option>
                    <?php
                        while ($namaRak = mysqli_fetch_array($rakArr))
                        {?>
                        <option value="<?php echo $namaRak['id']?>" class=><?php echo $namaRak['nama_rak']?></option>
                        <?php }?>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="insertBuku" class="btn btn-primary">Simpan Data</button>
            </div>
            </form>
            
        </div>
    </div>
</div>