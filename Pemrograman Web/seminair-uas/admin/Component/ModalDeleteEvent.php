<div class="modal fade" id="deleteEventModal<?= $event['id_event'] ?>" tabindex="-1" aria-labelledby="deleteEventModalLabel<?= $event['id_event'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEventModalLabel<?= $event['id_event'] ?>">Konfirmasi Hapus Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus event "<strong><?= htmlspecialchars($event['nama_event']) ?></strong>"?
                Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                <!-- action post delete -->
                <form action="../Routes/IndexAdmin.php?page=dataevent" method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id_event_to_delete" value="<?= $event['id_event'] ?>">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>