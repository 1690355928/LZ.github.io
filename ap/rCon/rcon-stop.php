<?php

session_start();
ob_start();

if (!isset($_SESSION['logged'])) {
    header('Location: ../index.php');
}
$staffPerms = $_SESSION['perms'];

if ($staffPerms['stopServer'] != '1') {
    header('Location: ../lvlError.php');
}

require_once '../ArmaRConClass/rcon.php';

include '../verifyPanel.php';
Rconconnect();

$command = '#shutdown';

$stop = $rcon->command($command);

header('Location: ../home.php');
