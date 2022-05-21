<div class="modal fade" id="pinjamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulir Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tubuh Modal -->
                <form action="insert/insertPinjam.php" method="POST">

                    <?php
                        include '../db.php';
                        // ngambil variabel buat pilihan
                        $anggotaArr = mysqli_query($conn, "SELECT id, nama from anggota");
                        $bukuArr = mysqli_query($conn, "SELECT id, judul from buku");
                    ?>

                    <div class="mb-3">
                        <label>Anggota yang Meminjam</label>
                        <br>
                        <select name="anggota">
                            <option value="0">-- Pilih --</option>
                            <?php
                            while ($anggota = mysqli_fetch_array($anggotaArr))
                            {
                            ?>
                            <option value="<?php echo $anggota['id']?>">
                                <?php echo $anggota['nama']?>
                            </option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Buku yang Dipinjam</label>
                        <br>
                        <select name="buku">
                            <option value="0">-- Pilih --</option>
                            <?php
                            while ($buku = mysqli_fetch_array($bukuArr))
                            {
                            ?>
                            <option value="<?php echo $buku['id']?>">
                                <?php echo $buku['judul']?>
                            </option>
                            <?php }?>
                        </select>
                    </div>

            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="insertPinjam" class="btn btn-primary">Pinjam</button>
                </div>
            </form>
        </div>
    </div>
</div>
