<?php
require_once 'config/init.php';
$history = getTrainingHistory();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Latihan - PokéCare</title>
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
                    <h1>Riwayat Latihan</h1>
                    <p>Jejak perjalanan latihan Pokémon Anda</p>
                </div>
            </div>
        </div>

        <div class="card">
            <?php if (empty($history)): ?>
                <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
                    <p style="font-size: 1.25rem;">Belum ada riwayat latihan</p>
                </div>
            <?php else: ?>
                <div class="history-list">
                    <?php foreach ($history as $record): ?>
                        <div class="history-item">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <span class="history-badge badge-<?= strtolower($record['trainingType']) ?>">
                                    <?php if ($record['trainingType'] === 'Attack'): ?>
                                        ⚡ Attack
                                    <?php elseif ($record['trainingType'] === 'Defense'): ?>
                                        🛡️ Defense
                                    <?php else: ?>
                                        💨 Speed
                                    <?php endif; ?>
                                </span>
                                <span style="color: var(--text-muted); font-size: 0.875rem;"><?= $record['timestamp'] ?></span>
                            </div>
                            
                            <div class="history-details">
                                <div>
                                    Level: <?= $record['previousLevel'] ?> → <?= $record['newLevel'] ?>
                                    <span class="history-stat-change">+<?= $record['newLevel'] - $record['previousLevel'] ?></span>
                                </div>
                                <div>
                                    HP: <?= $record['previousHP'] ?> → <?= $record['newHP'] ?>
                                    <span class="history-stat-change">+<?= $record['newHP'] - $record['previousHP'] ?></span>
                                </div>
                                <div>
                                    Intensitas: <?= $record['intensity'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="action-grid" style="margin-top: 2rem;">
                <a href="index.php" class="btn btn-primary btn-block">Kembali ke Beranda</a>
                <a href="training.php" class="btn btn-success btn-block">Latihan Lagi</a>
            </div>
        </div>
    </div>
</body>
</html>