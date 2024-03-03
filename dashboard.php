<?php ob_start(); ?>
<?php
    require('db/conn.php'); session_start(); $SessioneId = $_GET['SessioneId']; $pKey_UtenteId = $_GET['pKey_UtenteId']; $fKey_UtenteRuolo = $_GET['fKey_UtenteRuolo']; $desc_UtenteToken = $_GET['desc_UtenteToken']; $page = $_GET['page']; $status = $_GET['status'];

    /* controllo validità sessione */
    if(!$_SESSION['SessioneId'] && !$_SESSION['pKey_UtenteId']) {header('location: login.php?action=login&error=invalid_session&status=session_error');}
    else {
        /* recupero nome utente */
        $utente_nome__query = "SELECT desc_UtenteNome FROM tabella_utenti WHERE pKey_UtenteId = '$pKey_UtenteId' AND desc_UtenteToken = '$desc_UtenteToken'";
        $utente_nome__execute = $query_connection->query($utente_nome__query);
        $utente_nome__datum = $utente_nome__execute->fetch_assoc();
        $utente_nome = $utente_nome__datum['desc_UtenteNome'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compagnia | Area riservata</title>
        
        <style>
            div.big-container {
                width: 640px;
                height: auto;
                margin: 20px auto auto auto;
                padding: 10px 10px;
                border: 1px solid lightgrey;
                border-radius: 10px;
            }
            input#logout_button {
                width: auto;
                padding: 5px 15px;
                color: white;
                background-color: #EC7063;
                border: 1px solid black;
                text-transform: uppercase;
            }
            input#logout_button:hover {
                background-color: #CB4335;
                border: 1px solid black;
                text-transform: uppercase;
            }
            p.__welcome-message {
                font-family: 'Nunito Sans', sans-serif;
            }
            h3.section__title {
                font-family: 'Nunito Sans', sans-serif;
                text-transform: uppercase;
            }
            ._task_collaboratore {
                border-bottom: 0px;
                border-left: 0px;
                border-right: 0px;
                border-top: 1px solid grey;
            }
            .legend_task_collaboratore {
                padding: 5px 10px;
            }
            select.section__select {
                width: 100%;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding: 5px 5px;
            }
            input#button_add_task {
                width: auto;
                margin: 15px auto auto auto;
                padding: 5px 15px;
                color: white;
                background-color: #58D68D;
                border: 1px solid black;
                text-transform: uppercase;
            }
            input#button_add_task:hover {
                background-color: #229954;
                border: 1px solid black;
            }
            
            @media screen and (max-width: 768px) {
                div.big-container {
                    width: 80%;
                    height: auto;
                    margin: 15px auto auto auto;
                    padding: 10px 10px;
                    border: 0px;
                }
                img.__logo-img {
                    width: 90%;
                    height: auto;
                }
                .legend_task_collaboratore {
                    text-align: center;
                }
            }
        </style>
        
    </head>
    <body>
        <div class="big-container">
            <div class="big-container__header" style="display: flex;">
                <div class="header__logo" style="width: 50%;">
                    <img class="__logo-img" src="..." alt="logo">
                </div>
                <div class="header__action" style="text-align: right; width: 50%;">
                    <p class="__welcome-message">Benvenuto, <?php echo $utente_nome; ?></p>
                    <form action="logout.php" method="post">
                        <input type="hidden" name="SessioneId" value="<?php echo $SessioneId; ?>">
                        <input type="hidden" name="pKey_UtenteId" value="<?php echo $pKey_UtenteId; ?>">
                        <input id="logout_button" type="submit" value="esci">
                    </form>
                </div>
            </div>
            <div class="big-container__main">
                <?php
                    /* recupero token utente per controllo */
                    $utente_token_db__query = "SELECT desc_UtenteToken FROM tabella_utenti WHERE pKey_UtenteId = '$pKey_UtenteId'";
                    $utente_token_db__execute = $query_connection->query($utente_token_db__query);
                    $utente_token_db__datum = $utente_token_db__execute->fetch_assoc();
                    $utente_token_db = $utente_token_db__datum['desc_UtenteToken'];

                    /* verifica corrispondenza token */
                    if($utente_token_db == $desc_UtenteToken) {
                        if($page == 'home') {include('template/home.php');}
                        elseif($page == 'new_task') {include('template/new_task.php');}
                        elseif($page == 'show_task') {include('template/show_task.php');}
                    } else {include('error.php');}

                ?>
            </div>
        </div>
    </body>
</html>
<?php ob_start(); ?>
