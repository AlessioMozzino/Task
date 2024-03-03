<?php ob_start(); ?>
<div class="main__new-task">
    <br><br>
    <span><h3 class="section__title" style="display: inline; margin: 15px auto">assegnazione nuovo task</h3></span><span> - <a href="dashboard.php?SessioneId=<?php echo $SessioneId; ?>&pKey_UtenteId=<?php echo $pKey_UtenteId; ?>&fKey_UtenteRuolo=<?php echo $fKey_UtenteRuolo; ?>&desc_UtenteToken=<?php echo $desc_UtenteToken; ?>&page=home&status=none">torna indietro</a></span>
    <br><br>
    <div class="_message">
        <?php
            if($status == 'none') {$msg = ''; $bgc = 'white';}
            elseif($status == 'task_added') {$msg = 'task assegnato correttamente'; $bgc = 'green';}
            elseif($status == 'task_not_added') {$msg = 'task non assegnato'; $bgc = 'red';}

            echo '<p style="background-color:'.$bgc.'; color:white; margin:0px 0px;">'.$msg.'</p>'
        ?>
    </div>
    <form action="https://bonizzi.mozzino.it/dashboard.php?SessioneId=<?php echo $SessioneId; ?>&pKey_UtenteId=<?php echo $pKey_UtenteId; ?>&fKey_UtenteRuolo=<?php echo $fKey_UtenteRuolo; ?>&desc_UtenteToken=<?php echo $desc_UtenteToken; ?>&page=<?php echo $page; ?>&status=<?php echo $status; ?>" method="post">
        <legend>descrizione task</legend>
        <textarea name="task_descrizione" rows="8" cols="80" required style="width: 100%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box;"></textarea><br>
        <legend>assegna task a</legend>
        <select class="section__select" name="utente_task" required>
            <option value="00" disabled selected>-</option>
        <?php
            /* recupero nome utenti registrati come collaboratori */
            $utenti_nomi__query = "SELECT pKey_UtenteId, desc_UtenteNome FROM tabella_utenti WHERE fKey_UtenteRuolo = 1";
            $utenti_nomi__execute = $query_connection->query($utenti_nomi__query);
            while($utenti_nomi__datum = $utenti_nomi__execute->fetch_assoc()) {
                $utenti_id = $utenti_nomi__datum['pKey_UtenteId'];
                $utenti_nomi = $utenti_nomi__datum['desc_UtenteNome'];
        ?>
            <option value="<?php echo $utenti_id; ?>"><?php echo $utenti_nomi; ?></option>
        <?php
            }
        ?>
        </select><br>
        <input id="button_add_task" type="submit" name="add_task" value="assegna task">
    </form>
    <?php
        if(isset($_POST['add_task'])) {
            /* recupero variabili */
            $desc_TaskDescrizione = $_POST['task_descrizione'];
            $fKey_TaskTo = $_POST['utente_task'];

            /* procedura di registrazione task */
            $add_task__query = "INSERT INTO tabella_task(pKey_TaskId, desc_TaskDescrizione, fKey_TaskFrom, fKey_TaskTo, flag_TaskStato) VALUES('', '$desc_TaskDescrizione', '$pKey_UtenteId', '$fKey_TaskTo', 0)";
            if($add_task__execute = $query_connection->query($add_task__query)) {header('location: https://bonizzi.mozzino.it/dashboard.php?SessioneId='.$SessioneId.'&pKey_UtenteId='.$pKey_UtenteId.'&fKey_UtenteRuolo='.$fKey_UtenteRuolo.'&desc_UtenteToken='.$desc_UtenteToken.'&page='.$page.'&status=task_added');}
            else {header('location: https://bonizzi.mozzino.it/dashboard.php?SessioneId='.$SessioneId.'&pKey_UtenteId='.$pKey_UtenteId.'&fKey_UtenteRuolo='.$fKey_UtenteRuolo.'&desc_UtenteToken='.$desc_UtenteToken.'&page='.$page.'&status=task_not_added');}
        }
    ?>
</div>
<?php ob_start(); ?>