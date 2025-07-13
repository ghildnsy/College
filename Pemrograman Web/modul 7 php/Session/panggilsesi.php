<?php
    session_start();
    if(isset($_SESSION['var_session1']) and isset($_SESSION['var_session2'])){

        echo $_SESSION['var_session1']."<br>";
        echo $_SESSION['var_session2'];
    } else {
            echo "Sesi Kosong";
            }
    ?>