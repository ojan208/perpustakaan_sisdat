<div class="modal fade" id="angModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mendaftarkan anggota Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tubuh Modal -->
                <form action="insert/insertAng.php" method="POST">

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="Nama"
                        placeholder="Masukan Nama Anggota Baru">
                    </div>

                    <div class="mb-3">
                        <label>Nomor Telepon</label>
                        <input type="text" class="form-control" name="noTelp"
                        placeholder="Masukan Nomor Telepon Anggota Baru">
                    </div>

            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="insertAng" class="btn btn-primary">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>
