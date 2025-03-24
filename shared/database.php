<?php
$connexion = mysqli_connect('localhost', 'root', '', 'iibs_health_hub');

if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}