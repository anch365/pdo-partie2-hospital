<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/liste-rendezvous.php');
    exit();
}

if (!isset($_POST['id'])) {
    header('Location: ../public/liste-rendezvous.php?error=missing-value');
    exit();
}
if (empty($_POST['id'])) {
    header('Location: ../public/liste-rendezvous.php?error=value-empty');
    exit();
}

$id = (int) $_POST['id'];

require_once '../utils/db_connect.php';

$request = $db->prepare("DELETE FROM appointments WHERE id = :id");

$request->execute([
    ':id' => $id
]);

header('Location: ../public/liste-rendezvous.php');
exit();