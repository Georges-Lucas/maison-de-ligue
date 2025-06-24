<?php
session_start();
require_once '../model/Controller.inc.php';

if (!isset($_SESSION['user']) || empty($_SESSION['user']['is_admin']) || !$_SESSION['user']['is_admin']) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $pdo->prepare("DELETE FROM collaborateurs WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: liste.php');
exit;