<?php include(__DIR__ . '/../../../config.php'); ?>

<?php

$filter = $_GET['kategori'] ?? 'all';
$search = $_GET['search'] ?? '';

if (!empty($search)) {
    $search = mysqli_real_escape_string($db, $search);
    $sql = "SELECT event.*, kategori.nama_kategori 
            FROM event 
            JOIN kategori ON event.id_kategori = kategori.id_kategori 
            WHERE event.nama_event LIKE '%$search%' 
            OR event.lokasi_event LIKE '%$search%'
            OR event.penyelenggara_event LIKE '%$search%'";
} elseif ($filter === 'all') {
    $sql = "SELECT event.*, kategori.nama_kategori 
            FROM event 
            JOIN kategori ON event.id_kategori = kategori.id_kategori";
} else {
    $filter = mysqli_real_escape_string($db, $filter);
    $sql = "SELECT event.*, kategori.nama_kategori 
            FROM event 
            JOIN kategori ON event.id_kategori = kategori.id_kategori 
            WHERE kategori.nama_kategori = '$filter'";
}

$query = mysqli_query($db, $sql);

while ($value = mysqli_fetch_assoc($query)) {
    $id_event = $value['id_event'];
    $event_name = $value['nama_event'];
    $event_img = $value['gambar_event'];
    $event_date = date('d M Y', strtotime($value['tgl_event']));
    $event_location = $value['lokasi_event'];
    $organizer_event = $value['penyelenggara_event'];
    $nama_kategori = $value['nama_kategori'];
    $type_event = $value['tipe_event'];

    echo '
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card event-card border-0 shadow-sm h-100">
            <div class="event-image-container position-relative">
                <img src="../../assets/img/events/' . $event_img . '" class="card-img-top" alt="' . $event_name . '">
                <span class="badge text-capitalize bg-' . ($type_event == "gratis" ? "primary" : "danger") . ' event-badge">' . $type_event . '</span>
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="fw-semibold mb-1">'  . $event_name . '</h5>
                <p class="text-white small mb-3">' . $organizer_event . '</p>
                <ul class="list-unstyled small text-white mb-3 ">
                    <li class="mb-2"><i class="bi bi-geo-alt-fill text-primary me-1"></i>' . $event_location . '</li>
                    <li class="mb-2"><i class="bi bi-calendar2-plus-fill text-success me-1"></i>' . $event_date . '</li>
                    <li><i class="bi bi-tags-fill text-warning me-1"></i>' . ucwords(str_replace('_', ' ', $nama_kategori)) . '</li>
                </ul>
                <div class="mt-auto d-flex justify-content-between align-items-center">
                    <a href="/src/views/detailEvent.php?id=' . $id_event . '" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                    <button class="btn btn-light btn-sm rounded-circle like-button"><i class="bi bi-heart"></i></button>
                </div>
            </div>
        </div>
    </div>';
}
?>



<style>
    .event-card {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        color: white;
        transition: all 0.3s ease;
    }

    .event-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.25);
    }

    .event-image-container {
        position: relative;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .event-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 0.75rem;
        padding: 6px 10px;
        border-radius: 12px;
        backdrop-filter: blur(4px);
    }

    .like-button {
        border: none;
        background-color: rgba(255, 255, 255, 0.15);
        transition: background 0.2s, transform 0.2s;
    }

    .like-button:hover {
        background-color: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    .like-button i {
        color: white;
        transition: color 0.3s;
    }

    .like-button.liked i {
        color: #ff4d6d;
    }

    @keyframes pop {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.4);
        }

        100% {
            transform: scale(1);
        }
    }
</style>

<script>
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
</script>