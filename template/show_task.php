<?php ob_start(); ?>
<?php
    /* recupero variabili indispensabili */
    $pKey_UtenteId = $_GET['pKey_UtenteId'];
    $fKey_UtenteRuolo = $_GET['fKey_UtenteRuolo'];

    if($fKey_UtenteRuolo == 0) {
        /* post id utente */
        /* if(!$utente_task = $_GET['utente_task']) { */
        $utente_task = $_GET['fKey_TaskTo'];

        /* recupero nome utente selezionato */
        $utente_task_nome__query = "SELECT desc_UtenteNome FROM tabella_utenti WHERE pKey_UtenteId = '$utente_task'";
        $utente_task_nome__execute = $query_connection->query($utente_task_nome__query);
        $utente_task_nome__datum = $utente_task_nome__execute->fetch_assoc();
        $utente_task_nome = $utente_task_nome__datum['desc_UtenteNome'];
?>

<div class="main__show-task">
    <br><br>
    <span><h3 class="section__title" style="display: inline; margin: 15px auto">elenco task</h3></span><span> - <a href="dashboard.php?SessioneId=<?php echo $SessioneId; ?>&pKey_UtenteId=<?php echo $pKey_UtenteId; ?>&fKey_UtenteRuolo=<?php echo $fKey_UtenteRuolo; ?>&desc_UtenteToken=<?php echo $desc_UtenteToken; ?>&page=home&status=none">torna indietro</a></span>
    <br><br>
    <fieldset class="_task_collaboratore">
        <legend class="legend_task_collaboratore">task assegnati a <?php echo $utente_task_nome; ?></legend>
        <table>
            <tbody>
                <?php
                    /* recupero elenco task assegnati ad un collaboratore */
                    $elenco_task_collaboratore__query = "SELECT pKey_TaskId, desc_TaskDescrizione, flag_TaskStato FROM tabella_task WHERE fKey_TaskTo = '$utente_task'";
                    $elenco_task_collaboratore__execute = $query_connection->query($elenco_task_collaboratore__query);
                    while($elenco_task_collaboratore__datum = $elenco_task_collaboratore__execute->fetch_assoc()) {
                        $elenco_task_collaboratore__id = $elenco_task_collaboratore__datum['pKey_TaskId'];
                        $elenco_task_collaboratore__descrizione = $elenco_task_collaboratore__datum['desc_TaskDescrizione'];
                        $elenco_task_collaboratore__stato = $elenco_task_collaboratore__datum['flag_TaskStato'];
                ?>
                <tr>
                    <td style="border-bottom: 1px dashed grey;"><?php echo $elenco_task_collaboratore__descrizione; ?></td>
                    <td style="border-bottom: 1px dashed grey;">
                        <?php if($elenco_task_collaboratore__stato == 0) {
                            $src_img = 'https://bonizzi.mozzino.it/img/da-fare.png';
                            $text_alt_img = 'da fare';
                        } elseif($elenco_task_collaboratore__stato == 1) {
                            $src_img = 'https://bonizzi.mozzino.it/img/completato.png';
                            $text_alt_img = 'completato';
                        } ?>
                        <img src="<?php echo $src_img; ?>" alt="<?php echo $text_alt_img; ?>">
                    </td>
                    <td>
                        <?php if($elenco_task_collaboratore__stato == 0) {
                            $link_anchor = '';
                            $text_anchor = '';
                        } elseif($elenco_task_collaboratore__stato == 1) {
                            $link_anchor = 'https://bonizzi.mozzino.it/task.php?SessioneId=' . $SessioneId . '&pKey_UtenteId=' . $pKey_UtenteId . '&fKey_UtenteRuolo=' . $fKey_UtenteRuolo . '&desc_UtenteToken=' . $desc_UtenteToken . '&page=' . $page . '&status=' . $status . '&pKey_TaskId=' . $elenco_task_collaboratore__id . '&action=task_remove&fKey_TaskTo=' . $utente_task;
                            $text_anchor = 'rimuovi task';
                        } ?>
                        <a href="<?php echo $link_anchor; ?>"><?php echo $text_anchor; ?></a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </fieldset>
    <script type="text/javascript">
        function timedRefresh(time) {
            setTimeout(() => {
                location.reload(true);
            }, time)
        }
        (() => {
            timedRefresh(50000);
                setTimeout(() => {
                    document.getElementsByTagName("div");
                }, 200)
            })();
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</div>

<?php
} elseif($fKey_UtenteRuolo == 1) {
    /* recupero nome utente selezionato */
    $utente_task_nome__query = "SELECT desc_UtenteNome FROM tabella_utenti WHERE pKey_UtenteId = '$pKey_UtenteId'";
    $utente_task_nome__execute = $query_connection->query($utente_task_nome__query);
    $utente_task_nome__datum = $utente_task_nome__execute->fetch_assoc();
    $utente_task_nome = $utente_task_nome__datum['desc_UtenteNome'];
?>

<div class="main__show-task">
    <br><br>
    <span><h3 class="section__title" style="display: inline; margin: 15px auto">elenco task da fare</h3></span><span> - <a href="dashboard.php?SessioneId=<?php echo $SessioneId; ?>&pKey_UtenteId=<?php echo $pKey_UtenteId; ?>&fKey_UtenteRuolo=<?php echo $fKey_UtenteRuolo; ?>&desc_UtenteToken=<?php echo $desc_UtenteToken; ?>&page=home&status=none">torna indietro</a></span>
    <br><br>
    <fieldset class="_task_collaboratore">
        <legend class="legend_task_collaboratore">task assegnati a <?php echo $utente_task_nome; ?></legend>
        <table>
            <tbody>
                <?php
                    /* recupero elenco task assegnati ad un collaboratore */
                    $elenco_task_collaboratore__query = "SELECT pKey_TaskId, desc_TaskDescrizione, flag_TaskStato FROM tabella_task WHERE fKey_TaskTo = '$pKey_UtenteId' AND flag_TaskStato = 0";
                    $elenco_task_collaboratore__execute = $query_connection->query($elenco_task_collaboratore__query);
                    while($elenco_task_collaboratore__datum = $elenco_task_collaboratore__execute->fetch_assoc()) {
                        $elenco_task_collaboratore__id = $elenco_task_collaboratore__datum['pKey_TaskId'];
                        $elenco_task_collaboratore__descrizione = $elenco_task_collaboratore__datum['desc_TaskDescrizione'];
                        $elenco_task_collaboratore__stato = $elenco_task_collaboratore__datum['flag_TaskStato'];
                ?>
                <tr>
                    <td style="border-bottom: 1px dashed grey;"><?php echo $elenco_task_collaboratore__descrizione; ?></td>
                    <td style="border-bottom: 1px dashed grey;">
                        <a href="https://bonizzi.mozzino.it/task.php?SessioneId=<?php echo $SessioneId; ?>&pKey_UtenteId=<?php echo $pKey_UtenteId; ?>&fKey_UtenteRuolo=<?php echo $fKey_UtenteRuolo; ?>&desc_UtenteToken=<?php echo $desc_UtenteToken; ?>&page=<?php echo $page; ?>&status=<?php echo $status; ?>&pKey_TaskId=<?php echo $elenco_task_collaboratore__id; ?>&action=task_done">task completato</a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </fieldset>
</div>

<?php } ?>
<?php ob_start(); ?>