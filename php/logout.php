<?php

// The beginning of the session
    session_start();

    setcookie(session_name(), '', 100);
    session_unset();
    session_destroy();
    
    $_SESSION = array();

    header("Location: login.php");

?>