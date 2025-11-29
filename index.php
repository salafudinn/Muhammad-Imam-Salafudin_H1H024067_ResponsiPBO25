<?php
require_once 'config/init.php';
$fearow = getFearow();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokéCare System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <div class="header-icon">
                    <img src="assets/images/fearow.png" alt="Fearow" style="width: 3rem; height: 3rem; object-fit: contain;">
                </div>
                <div class="header-text">
                    <h1>PokéCare System</h1>
                    <p>Pokémon Research & Training Center</p>
                </div>
            </div>
            <a href="?action=reset" class="btn btn-danger" onclick="return confirm('Reset semua data?')">
                Reset Level
            </a>
        </div>

        <div class="card">
            <div class="pokemon-profile">
                <div class="pokemon-avatar">
                    <img src="assets/images/fearow.png" alt="Fearow" class="pokemon-avatar-img">
                </div>
                <h2 class="pokemon-name"><?= $fearow->getName() ?></h2>
                <span class="pokemon-type"><?= $fearow->getType() ?></span>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Level</div>
                    <div class="stat-value"><?= $fearow->getLevel() ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">HP</div>
                    <div class="stat-value"><?= round($fearow->getHP()) ?></div>
                </div>
            </div>

            <div class="special-move">
                <h3><span>⚡</span> Jurus Spesial</h3>
                <p class="special-move-name"><?= $fearow->getSpecialMove() ?></p>
                <p class="special-move-desc"><?= $fearow->specialMoveDescription() ?></p>
                <p class="intimidate-text"><?= $fearow->intimidate() ?></p>
            </div>

            <div class="action-grid">
                <a href="training.php" class="btn btn-success btn-block">
                    <span>💪</span> Mulai Latihan
                </a>
                <a href="history.php" class="btn btn-primary btn-block">
                    <span>📜</span> Riwayat Latihan
                </a>
            </div>
        </div>
    </div>
</body>
</html>