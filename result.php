<?php
require_once 'config/init.php';

if (!isset($_SESSION['training_result'])) {
    header('Location: index.php');
    exit;
}

$result = $_SESSION['training_result'];
$fearow = getFearow();
unset($_SESSION['training_result']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Latihan - PokéCare</title>
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
                    <h1>Latihan Selesai!</h1>
                    <p>Hasil latihan Pokémon Anda</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="result-header">
                <h1>Latihan Berhasil!</h1>
                <p style="color: var(--text-muted);">Kemampuan Pokémon Anda telah meningkat</p>
            </div>

            <div class="stats-grid" style="margin-bottom: 3rem;">
                <div class="stat-card">
                    <div class="stat-label">Level</div>
                    <div class="stat-comparison">
                        <span><?= $result['previousLevel'] ?></span>
                        <span class="arrow-right">→</span>
                        <span style="color: var(--success); font-weight: bold;"><?= $result['newLevel'] ?></span>
                    </div>
                    <div style="color: var(--success); font-size: 0.875rem; margin-top: 0.5rem;">
                        +<?= $result['newLevel'] - $result['previousLevel'] ?> Level
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">HP</div>
                    <div class="stat-comparison">
                        <span><?= $result['previousHP'] ?></span>
                        <span class="arrow-right">→</span>
                        <span style="color: var(--success); font-weight: bold;"><?= $result['newHP'] ?></span>
                    </div>
                    <div style="color: var(--success); font-size: 0.875rem; margin-top: 0.5rem;">
                        +<?= $result['newHP'] - $result['previousHP'] ?> HP
                    </div>
                </div>
            </div>

            <div class="special-move">
                <h3><span>⚡</span> Jurus Spesial</h3>
                <p class="special-move-desc"><?= $fearow->specialMoveDescription() ?></p>
            </div>

            <div class="action-grid">
                <a href="index.php" class="btn btn-primary btn-block">
                    <span>🏠</span> Beranda
                </a>
                <a href="history.php" class="btn btn-secondary btn-block">
                    <span>📜</span> Riwayat
                </a>
            </div>
        </div>
    </div>
</body>
</html>