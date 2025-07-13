    <div class="modal fade" id="editEventModal<?= $event['id_event'] ?>" tabindex="-1" aria-labelledby="editEventModalLabel<?= $event['id_event'] ?>" aria-hidden="false">
        <div class="modal-dialog">
            <form action="../Routes/IndexAdmin.php?page=dataevent" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_event" value="<?= $event['id_event'] ?>">
                <input type="hidden" name="gambar_event_lama" value="<?= htmlspecialchars($event['gambar_event']) ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEventModalLabel<?= $event['id_event'] ?>">Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Kategori</label>
                            <select class="form-select" name="id_kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($listKategori as $kategori) : ?>
                                    <option value="<?= $kategori['id_kategori'] ?>"
                                        <?= ($kategori['id_kategori'] == $event['id_kategori']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($kategori['nama_kategori']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_event" class="form-label">Nama Event</label>
                            <input type="text" class="form-control" name="nama_event" value="<?= htmlspecialchars($event['nama_event']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="gambar_event" class="form-label">Ganti Gambar (kosongkan jika tidak diganti)</label>
                            <input type="file" class="form-control" name="gambar_event">
                            <small class="text-muted">Gambar saat ini: <?= htmlspecialchars($event['gambar_event']) ?></small>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_event" class="form-label">Tanggal & Waktu</label>
                            <input type="datetime-local" class="form-control" name="tgl_event" value="<?= date('Y-m-d\TH:i', strtotime($event['tgl_event'])) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_event" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi_event" value="<?= htmlspecialchars($event['lokasi_event']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="penyelenggara_event" class="form-label">Penyelenggara</label>
                            <input type="text" class="form-control" name="penyelenggara_event" value="<?= htmlspecialchars($event['penyelenggara_event']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_event" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi_event" required><?= htmlspecialchars($event['deskripsi_event']) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tipe_event" class="form-label">Tipe Event</label>
                            <select name="tipe_event" required>
                                <option value="berbayar" <?= $event['tipe_event'] == 'berbayar' ? 'selected' : '' ?>>Berbayar</option>
                                <option value="gratis" <?= $event['tipe_event'] == 'gratis' ? 'selected' : '' ?>>Gratis</option>
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="harga_event" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga_event" value="<?= htmlspecialchars($event['harga_event']) ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Update Event</button>
                    </div>
                </div>
            </form>
        </div>
    </div>