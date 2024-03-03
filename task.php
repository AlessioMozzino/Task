<?php
    require('db/conn.php');

    /* recupero parametro action */
    $action = $_GET['action'];

    /* veicolazione delle attività */
    if($action == 'task_done') {
        /* recupero id task */
        $pKey_TaskId = $_GET['pKey_TaskId'];

        /* processo di completamento task */
        $task_done__query = "UPDATE tabella_task SET flag_TaskStato = 1 WHERE pKey_TaskId = '$pKey_TaskId'";
        $task_done__execute = $query_connection->query($task_done__query);

        /* recupero variabili per ridirezione */
        $SessioneId = $_GET['SessioneId'];
        $pKey_UtenteId = $_GET['pKey_UtenteId'];
        $fKey_UtenteRuolo = $_GET['fKey_UtenteRuolo'];
        $desc_UtenteToken = $_GET['desc_UtenteToken'];
        $page = $_GET['page'];
        $status = $_GET['status'];

        /* ridirezione */
        header('location: http://bonizzi.mozzino.it/dashboard.php?SessioneId=' . $SessioneId . '&pKey_UtenteId=' . $pKey_UtenteId . '&fKey_UtenteRuolo=' . $fKey_UtenteRuolo . '&desc_UtenteToken=' . $desc_UtenteToken .'&page=' . $page . '&status=' . $status);
    } elseif($action == 'task_remove') {
        /* recupero id task */
        $pKey_TaskId = $_GET['pKey_TaskId'];

        /* processo di completamento task */
        $task_remove__query = "DELETE FROM tabella_task WHERE pKey_TaskId = '$pKey_TaskId'";
        $task_remove__execute = $query_connection->query($task_remove__query);

        /* recupero variabili per ridirezione */
        $SessioneId = $_GET['SessioneId'];
        $pKey_UtenteId = $_GET['pKey_UtenteId'];
        $fKey_UtenteRuolo = $_GET['fKey_UtenteRuolo'];
        $desc_UtenteToken = $_GET['desc_UtenteToken'];
        $page = $_GET['page'];
        $status = $_GET['status'];
        $fKey_TaskTo = $_GET['fKey_TaskTo'];

        /* ridirezione */
        header('location: http://bonizzi.mozzino.it/dashboard.php?SessioneId=' . $SessioneId . '&pKey_UtenteId=' . $pKey_UtenteId . '&fKey_UtenteRuolo=' . $fKey_UtenteRuolo . '&desc_UtenteToken=' . $desc_UtenteToken .'&page=' . $page . '&status=' . $status . '&fKey_TaskTo=' . $fKey_TaskTo);
    }
?>