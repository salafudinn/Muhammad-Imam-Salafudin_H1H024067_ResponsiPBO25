<?php
session_start();

require_once __DIR__ . '/../classes/Pokemon.php';
require_once __DIR__ . '/../classes/FlyingTypePokemon.php';
require_once __DIR__ . '/../classes/Fearow.php';

if (!isset($_SESSION['fearow'])) {
    $_SESSION['fearow'] = serialize(new Fearow());
    $_SESSION['trainingHistory'] = [];
}

function getFearow() {
    return unserialize($_SESSION['fearow']);
}

function saveFearow($fearow) {
    $_SESSION['fearow'] = serialize($fearow);
}

function addTrainingHistory($record) {
    array_unshift($_SESSION['trainingHistory'], $record);
}

function getTrainingHistory() {
    return $_SESSION['trainingHistory'];
}

function resetData() {
    $_SESSION['fearow'] = serialize(new Fearow());
    $_SESSION['trainingHistory'] = [];
}

if (isset($_GET['action']) && $_GET['action'] === 'reset') {
    resetData();
    header('Location: index.php');
    exit;
}
?>