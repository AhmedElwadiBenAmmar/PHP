<?php


session_start();
function connexion(){
    return mysqli_connect("localhost", "root", "", "wadi");
}
?>