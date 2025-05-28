<?php
ini_set('display_erros',1);
error_reporting(E_ALL);
session_start();

if($_SESSION){
    echo $_SESSION['USUARIO'];
}
else echo '';