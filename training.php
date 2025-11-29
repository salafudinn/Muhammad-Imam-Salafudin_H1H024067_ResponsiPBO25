<?php
require_once 'config/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fearow = getFearow();
    $trainingType = $_POST['trainingType'];
    $intensity = intval($_POST['intensity']);
    
    $result = $fearow->train($trainingType, $intensity);
    saveFearow($fearow);
    addTrainingHistory($result);
    
    $_SESSION['training_result'] = $result;
    header('Location: result.php');
    exit;
}

$fearow = getFearow();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Latihan - PokéCare</title>
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
                    <h1>Sesi Latihan Fearow</h1>
                    <p>Tingkatkan kemampuan Pokémon Anda</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="stats-grid" style="margin-bottom: 2rem;">
                <div class="stat-card">
                    <div class="stat-label">Level Saat Ini</div>
                    <div class="stat-value"><?= $fearow->getLevel() ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">HP Saat Ini</div>
                    <div class="stat-value"><?= round($fearow->getHP()) ?></div>
                </div>
            </div>

            <form method="POST">
                <h3 style="margin-bottom: 1rem;">Pilih Jenis Latihan</h3>
                <div class="training-options">
                    <div>
                        <input type="radio" name="trainingType" value="Attack" id="attack" class="training-radio" checked>
                        <label for="attack" class="training-label">
                            <span class="training-icon">⚡</span>
                            <span>Attack</span>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="trainingType" value="Defense" id="defense" class="training-radio">
                        <label for="defense" class="training-label">
                            <span class="training-icon">🛡️</span>
                            <span>Defense</span>
                        </label>
                    </div>
                    <div>
                        <input type="radio" name="trainingType" value="Speed" id="speed" class="training-radio">
                        <label for="speed" class="training-label">
                            <span class="training-icon">💨</span>
                            <span>Speed</span>
                        </label>
                    </div>
                </div>

                <div class="range-container">
                    <h3 style="margin-bottom: 1rem;">
                        Intensitas Latihan: <span id="intensityValue" style="color: var(--primary);">50</span>
                    </h3>
                    <input type="range" name="intensity" min="10" max="100" value="50" oninput="document.getElementById('intensityValue').textContent = this.value">
                    <div class="range-labels">
                        <span>Ringan (10)</span>
                        <span>Sedang (50)</span>
                        <span>Berat (100)</span>
                    </div>
                </div>

                <div class="action-grid">
                    <a href="index.php" class="btn btn-secondary btn-block">Kembali</a>
                    <button type="submit" class="btn btn-primary btn-block">Mulai Latihan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>