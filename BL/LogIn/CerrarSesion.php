<?php
    if(!isset($_SESSION))
    {
        unset($_SESSION);
        header("Location: .../../GUI/Login/Login.php");
    }
    
/////////////////////////////////////////////////////////////////////
