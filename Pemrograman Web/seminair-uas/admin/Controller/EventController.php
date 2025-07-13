<?php

require_once __DIR__ . '/../Models/Event.php';
require_once __DIR__ . '/../Models/Peserta.php';

class EventController
{

    private $eventModel;
    private $pesertaModel;

    public function __construct($db)
    {
        $this->eventModel = new Event($db);
        $this->pesertaModel = new Peserta($db);
    }

    public function dashboard()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: admin_login.php");
            exit;
        }

        $totalEvents = $this->getTotalEvents();
        include __DIR__ . '/../Views/Dashboard.php';
    }

    // get total events
    public function getTotalEvents()
    {
        return $this->eventModel->getTotalEvents();
    }

    // get total categories
    public function getTotalCategories()
    {
        return $this->eventModel->getTotalCategories();
    }

    // get all categories
    public function getAllCategories()
    {
        return $this->eventModel->getAllCategories();
    }

    // get all events
    public function getAllEvents()
    {
        return $this->eventModel->getAllEvents();
    }

    // insert event
    public function addEvent($data)
    {
        return $this->eventModel->insertEvent($data);
    }

    // update event
    public function updateEvent($data) // Menerima data langsung
    {
        return $this->eventModel->updateEvent($data);
    }

    // delete event
    public function deleteEvent($id_event)
    {
        // Ambil nama gambar event sebelum dihapus dari database
        $eventData = $this->eventModel->getEventById($id_event);
        $gambar_event = $eventData['gambar_event'] ?? null;

        $success = $this->eventModel->deleteEvent($id_event);

        if ($success && $gambar_event) {
            $imgPath = __DIR__ . '/../../assets/img/events/' . $gambar_event;
            if (file_exists($imgPath)) {
                unlink($imgPath); // Hapus file gambar 
            }
        }
        return $success;
    }

    // get participant
    public function getParticipants($id_event = null)
    {
        return $this->pesertaModel->getFilteredPeserta($id_event);
    }

    // get filtered participants
    public function getFilteredPeserta($eventId = null)
    {
        return $this->pesertaModel->getFilteredPeserta($eventId);
    }
}
