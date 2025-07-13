<?php include(__DIR__ . '/../../../config.php'); ?>

<?php
// Cek koneksi database
if (!$db) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM event WHERE id_kategori = 3 ORDER BY id_event DESC LIMIT 3";
$query = mysqli_query($db, $sql);

if ($query) {
    while ($event = mysqli_fetch_assoc($query)) {
        $id_event = $event['id_event'];
        $event_name = htmlspecialchars($event['nama_event']);
        $event_img = htmlspecialchars($event['gambar_event']);
        $event_date = date('d M Y', strtotime($event['tgl_event']));
        $event_location = htmlspecialchars($event['lokasi_event']);
        $organizer_event = htmlspecialchars($event['penyelenggara_event']);

        echo '
        <div class="col-md-4 mb-4 d-flex">
            <div class="card flex-fill shadow-sm border-0">
                <img src="../../assets/img/events/' . $event_img . '" class="card-img-top" alt="' . $event_name . '">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="text-paragraph text-primary fw-semibold">
                            <i class="text-primary bi bi-geo-alt-fill"></i> <span>' . $event_location . '</span>
                        </div>
                        <div class="text-paragraph text-primary fw-semibold">
                            <i class="bi bi-calendar2-plus-fill"></i> <span>' . $event_date . '</span>
                        </div>
                    </div>
                    <h5 class="card-title">' . $event_name . '</h5>
                    <p class="card-text">' . $organizer_event . '</p>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light">
                    <a href="/src/views/detailEvent.php?id=' . $id_event . '" class="btn btn-dark btn-sm">More Details</a>
                    <button class="btn btn-dark btn-sm rounded-circle like-button">
                        <i class="bi bi-heart"></i>
                    </button>
                </div>
            </div>
        </div>';
    }
} else {
    echo "<p>Gagal mengambil data event.</p>";
}
?>

<style>
    .like-button {
        border: none;
        background-color: rgba(0, 0, 0, 0.67);
        transition: background 0.2s, transform 0.2s;
    }

    .like-button:hover {
        background-color: rgba(0, 0, 0, 0.83);
    }

    .like-button i {
        color: white;
        transition: color 0.3s;
    }

    .like-button.liked i {
        color: #ff4d6d;
    }

    .card-img-top {
        height: 300px;
        object-fit: cover;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('i');
                this.classList.toggle('liked');

                if (this.classList.contains('liked')) {
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                } else {
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                }
            });
        });
    });
</script>