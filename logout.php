<?php ob_start(); ?>
<?php
    session_start();

    /* recupero variabili di sessione */
    $SessioneId = $_POST['SessioneId'];
    $pKey_UtenteId = $_POST['pKey_UtenteId'];

    /* pulizia variabili di sessione e distruzione della sessione */
    session_unset();
    session_destroy();

    /* ridirezione */
    header('location: https://bonizzi.mozzino.it/login.php?action=logout&error=none&status=ready');
?>
<?php ob_start(); ?>