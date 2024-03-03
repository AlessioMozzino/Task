<?php ob_start(); ?>
<?php session_start(); ?>
<?php require('db/conn.php'); $action = $_GET['action']; $error = $_GET['error']; $status = $_GET['status']; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Amministrazioni Bonizzi | Accesso area riservata</title>
        
        <style>
            div._message {
                width: 480px;
                height: 50px;
                margin: 30px auto auto auto;
                padding: 10px 10px;
                text-align: center;
                text-transform: uppercase;
            }
            p._message-error {
                font-family: 'Nunito Sans', sans-serif;
                padding: 10px 10px;
            }
            div.big-container {
                width: 480px;
                height: auto;
                margin: 50px auto auto auto;
                border: 1px solid lightgrey;
                border-radius: 10px;
                padding: 10px 10px;
            }
            div.big-container__header {
                text-align: center;
            }
            div.big-container__description {
                text-align: center;
                text-transform: uppercase;
                margin: 10px auto;
                border-top: 1px solid lightgrey;
                border-bottom: 1px solid lightgrey;
            }
            p.__description-text {
                font-family: 'Nunito Sans', sans-serif;
            }
            .main__legend {
                font-family: 'Nunito Sans', sans-serif;
                text-transform: uppercase;
                margin: 10px auto;
            }
            input {
                width: 100%;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;    
                box-sizing: border-box;
                padding: 5px 5px;
            }
            input#button_login {
                margin: 20px auto auto auto;
                text-transform: uppercase;
                color: white;
                background-color: #5DADE2;
                border: 1px solid #2471A3;
            }
            input#button_login:hover {
                background-color: #2E86C1;
                border: 1px solid #2471A3;
            }
            div.big-container__footer {
                text-align: center;
                text-transform: uppercase;
            }
            p.footer__text {
                font-size: 10pt;
                font-family: 'Nunito Sans', sans-serif;
            }
            
            
            @media screen and (max-width: 768px) {
                div.big-container {
                    width: 80%;
                    height: auto;
                    margin: 50px auto auto auto;
                    padding: 10px 5px;
                    border: 0px;
                }
                p.footer__text {
                    font-size: 8pt;
                }
                div._message {
                    width: 80%;
                    height: 50px;
                    margin: 20px auto auto auto;
                    padding: 10px 10px;
            }
            }   
        </style>
        
    </head>
    <body>
        <div class="_message">
            <?php
                if($status == 'ready' && $error == 'none') {$msg = ''; $bgc = 'white';}
                elseif($status == 'login_error' && $error == 'invalid_user') {$msg = 'utente non trovato'; $bgc = 'red';}
                elseif($status == 'login_error' && $error == 'invalid_password') {$msg = 'password errata'; $bgc = 'red';}
                elseif($status == 'session_error' && $error == 'invalid_session') {$msg = 'sessione non valida'; $bgc = 'red';}

                echo '<p class="_message-error" style="background-color:'.$bgc.'; color:white; margin:0px 0px;">'.$msg.'</p>'
            ?>
        </div>
        <div class="big-container">
            <div class="big-container__header">
                <img src="https://www.amministrazionibonizzi.it/img/logo.png" alt="">
            </div>
            <div class="big-container__description">
                <?php if($action == 'login' || $action == 'logout') {echo '<p class="__description-text">accesso area riservata</p>';} else {echo '<p class="__description-text">invalid action</p>';} ?>
            </div>
            <div class="big-container__main">
                <form action="login.php?action=<?php echo $action; ?>&error=<?php echo $error; ?>&status=<?php echo $status; ?>" method="post">
                    <div class="main__legend">
                        <legend>indirizzo e-mail</legend>
                    </div>
                    <div class="main__field">
                        <input type="mail" name="email_post" required>
                    </div>
                    <div class="main__legend">
                        <legend>password</legend>
                    </div>
                    <div class="main__field">
                        <input type="password" name="password_post" required>
                    </div>
                    <div class="main__field">
                        <input id="button_login" type="submit" name="btn_login" value="accedi">
                    </div>
                </form>
            </div>
            <div class="big-container__footer">
                <p class="footer__text">via giacomo matteotti, 173 | 17022, Borgio Verezzi (SV)</p>
            </div>
        </div>
        <?php
            if(isset($_POST['btn_login'])) {
                /* recupero e-mail e password */
                $email_post = $_POST['email_post'];
                $password_post = sha1($_POST['password_post']);

                /* conteggio corrispondenza e-mail */
                $count_email__query = "SELECT COUNT(desc_UtenteEmail) FROM tabella_utenti WHERE desc_UtenteEmail = '$email_post' AND flag_UtenteStato = 1";
                $count_email__execute = $query_connection->query($count_email__query);
                $count_email__datum = $count_email__execute->fetch_assoc();
                $count_email = $count_email__datum['COUNT(desc_UtenteEmail)'];

                /* verifica corrispondenza e-mail */
                if($count_email == 1) {
                    /* recupero password registrata nel database per l'utente in fase di accesso */
                    $password_db__query = "SELECT desc_UtentePassword FROM tabella_utenti WHERE desc_UtenteEmail = '$email_post'";
                    $password_db__execute = $query_connection->query($password_db__query);
                    $password_db__datum = $password_db__execute->fetch_assoc();
                    $password_db = $password_db__datum['desc_UtentePassword'];

                    /* verifica correttezza password inserita */
                    if($password_post == $password_db) {
                        /* inizio sessione */
                        

                        /* recupero info utente */
                        $utente_info__query = "SELECT pKey_UtenteId, fKey_UtenteRuolo, desc_UtenteToken FROM tabella_utenti WHERE desc_UtenteEmail = '$email_post'";
                        $utente_info__execute = $query_connection->query($utente_info__query);
                        $utente_info__datum = $utente_info__execute->fetch_assoc();
                        $utente_id = $utente_info__datum['pKey_UtenteId'];
                        $utente_ruolo = $utente_info__datum['fKey_UtenteRuolo'];
                        $utente_token = $utente_info__datum['desc_UtenteToken'];

                        /* assegnazione varibili di sessione */
                        $_SESSION['SessioneId'] = session_id();
                        $_SESSION['pKey_UtenteId'] = $utente_id;

                        /* ridirezione */
                        header('location: https://bonizzi.mozzino.it/dashboard.php?SessioneId='.$_SESSION['SessioneId'].'&pKey_UtenteId='.$_SESSION['pKey_UtenteId'].'&fKey_UtenteRuolo='.$utente_ruolo.'&desc_UtenteToken='.$utente_token.'&page=home&status=none');
                    } elseif(sha1($password_post) != $utente_password) {
                        header('location: https://bonizzi.mozzino.it/login.php?action=login&error=invalid_password&status=login_error');
                    }
                } elseif($count_email == 0) {
                    header('location: https://bonizzi.mozzino.it/login.php?action=login&error=invalid_user&status=login_error');
                }
            }
        ?>
    </body>
</html>
<?php ob_start(); ?>