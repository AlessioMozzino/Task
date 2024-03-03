<?php ob_start(); ?>
<div class="main__section">
    <h3 class="section__title">task</h3>
    <p><?php if($fKey_UtenteRuolo == 0) { ?>
        <a href="https://bonizzi.mozzino.it/dashboard.php?SessioneId=<?php echo $SessioneId; ?>&pKey_UtenteId=<?php echo $pKey_UtenteId; ?>&fKey_UtenteRuolo=<?php echo $fKey_UtenteRuolo; ?>&desc_UtenteToken=<?php echo $desc_UtenteToken; ?>&page=new_task&status=<?php echo $status; ?>">aggiungi task</a>
        <fieldset class="_task_collaboratore">
            <legend class="legend_task_collaboratore">oppure</legend>
            <p>visualizza i task assegnati ad un collaboratore</p>
            <?php
                /* recupero nome utenti registrati come collaboratori */
                $utenti_nomi__query = "SELECT pKey_UtenteId, desc_UtenteNome FROM tabella_utenti WHERE fKey_UtenteRuolo = 1";
                $utenti_nomi__execute = $query_connection->query($utenti_nomi__query);
                while($utenti_nomi__datum = $utenti_nomi__execute->fetch_assoc()) {
                    $utenti_id = $utenti_nomi__datum['pKey_UtenteId'];
                    $utenti_nomi = $utenti_nomi__datum['desc_UtenteNome'];
            ?>
            <a href="https://bonizzi.mozzino.it/dashboard.php?SessioneId=<?php echo $SessioneId; ?>&pKey_UtenteId=<?php echo $pKey_UtenteId; ?>&fKey_UtenteRuolo=<?php echo $fKey_UtenteRuolo; ?>&desc_UtenteToken=<?php echo $desc_UtenteToken; ?>&page=show_task&status=<?php echo $status; ?>&fKey_TaskTo=<?php echo $utenti_id; ?>"><?php echo $utenti_nomi; ?></a>
            <?php } ?>
        </fieldset>
        <?php } elseif($fKey_UtenteRuolo == 1) { ?>
        <a href="https://bonizzi.mozzino.it/dashboard.php?SessioneId=<?php echo $SessioneId; ?>&pKey_UtenteId=<?php echo $pKey_UtenteId; ?>&fKey_UtenteRuolo=<?php echo $fKey_UtenteRuolo; ?>&desc_UtenteToken=<?php echo $desc_UtenteToken; ?>&page=show_task&status=<?php echo $status; ?>">elenco task</a>
        <?php } ?>
    </p>
</div>
<?php ob_start(); ?>