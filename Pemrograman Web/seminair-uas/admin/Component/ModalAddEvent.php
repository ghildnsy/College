    <div class="modal fade" id="tambahEventModal" tabindex="-1" aria-labelledby="tambahEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="../Routes/IndexAdmin.php?page=dataevent" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahEventModalLabel">Tambah Event Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form fields -->
                        <div class="mb-3">
                            <select class="form-select  mb-3" aria-label=".form-select-lg example" name="id_kategori" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($listKategori as $kategori): ?>
                                    <option value="<?= $kategori['id_kategori'] ?>">
                                        <?= ucwords(str_replace('_', ' ', $kategori['nama_kategori'])) ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="nama_event" class="form-label">Nama Event</label>
                            <input type="text" class="form-control" id="nama_event" name="nama_event" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar_event" class="form-label">Gambar Event</label>
                            <input type="file" class="form-control" id="gambar_event" name="gambar_event" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_event" class="form-label">Tanggal & Waktu</label>
                            <input type="datetime-local" class="form-control" id="tgl_event" name="tgl_event" required>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_event" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi_event" name="lokasi_event" required>
                        </div>
                        <div class="mb-3">
                            <label for="penyelenggara_event" class="form-label">Penyelenggara</label>
                            <input type="text" class="form-control" id="penyelenggara_event" name="penyelenggara_event" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_event" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_event" name="deskripsi_event" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tipe_event" class="form-label">Tipe Event</label>
                            <select class="form-select" id="tipe_event" name="tipe_event" required>
                                <option value="" disabled selected>Pilih tipe event</option>
                                <option value="berbayar">Berbayar</option>
                                <option value="gratis">Gratis</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga_event" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga_event" name="harga_event" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Event</button>
                    </div>
                </div>
            </form>
        </div>
    </div>