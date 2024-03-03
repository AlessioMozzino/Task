<?php
    $host = 'www.mozzino.it';
    $user = 'hkguaplm';
    $pass = 's#;W9%Fb#)4XUT{.,dLS{$[a0';
    $db_name = 'hkguaplm_mozzino';

    /* Connessione al database */
    $query_connection = new mysqli($host, $user, $pass, $db_name);
    if ($query_connection->connect_error) {
        die('Errore di connessione (' . $query_connection->connect_errno . ') '. $query_connection->connect_error);
    }

    $query_utf8 = "SET NAMES utf8";
    $query_connection->query($query_utf8);
?>
