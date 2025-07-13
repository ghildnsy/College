<?php
    session_start();
    $_SESSION['var_session1']='Ghildan Syarif Ayatullah';
    $_SESSION['var_session2']='085156788177';
    
        if(isset($_SESSION['var_session1']) and isset($_SESSION['var_session2']))
        {
            echo "Session Baru Saja Dibuat";
        }
?>