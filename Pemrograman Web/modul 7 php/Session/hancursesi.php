<?php
    session_start();

    echo $_SESSION['var_session1']."<br>";
    echo $_SESSION['var_session2']."<br>";

    echo("Seluruh Sesi Telah dihapus");

    session_destroy();
?>