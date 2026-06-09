<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/liste-patient.php');
    exit();
}

if (!isset($_POST['id'])) {
    header('Location: ../public/liste-patient.php?error=missing-value');
    exit();
}
if (empty($_POST['id'])) {
    header('Location: ../public/liste-patient.php?error=value-empty');
    exit();
}

$id = (int) $_POST['id'];

require_once '../utils/db_connect.php';
$request = $db->prepare("DELETE FROM appointments
    WHERE patient_id = :id
");

$request->execute([
    ':id' => $id
]);

$request = $db->prepare("DELETE FROM patients WHERE id = :id");

$request->execute([
    ':id' => $id
]);

header('Location: ../public/liste-patient.php');
exit();
