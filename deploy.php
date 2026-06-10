<?php
/**
 * TechNews - Web Deploy Helper
 * Upload file ini ke root hosting, akses via browser SEKALI SAJA,
 * lalu HAPUS setelah selesai untuk keamanan!
 *
 * URL: https://domainanda.com/deploy.php?token=technews2024
 */

define('DEPLOY_TOKEN', 'technews2024');

if (!isset($_GET['token']) || $_GET['token'] !== DEPLOY_TOKEN) {
    die('<h2>403 Forbidden</h2><p>Token tidak valid.</p>');
}

$output = [];

function run($cmd) {
    global $output;
    $result = shell_exec($cmd . ' 2>&1');
    $output[] = "<strong>$ $cmd</strong><br>" . nl2br(htmlspecialchars($result ?? '(no output)')) . "<br>";
}

// Set path ke folder Laravel (sesuaikan jika perlu)
$laravelPath = __DIR__;
chdir($laravelPath);

echo '<html><head><meta charset="utf-8"><style>
body{font-family:monospace;background:#1e1e1e;color:#d4d4d4;padding:20px;}
strong{color:#4ec9b0;}
.success{color:#6a9955;}
.error{color:#f44747;}
hr{border-color:#333;}
</style></head><body>';
echo '<h2 style="color:#569cd6;">TechNews Deploy Helper</h2>';
echo '<p>Menjalankan setup...</p><hr>';

run('php artisan key:generate --force');
run('php artisan migrate --force');
run('php artisan db:seed --force');
run('php artisan storage:link');
run('php artisan config:cache');
run('php artisan route:cache');
run('php artisan view:cache');

foreach ($output as $line) {
    echo "<p>$line</p>";
}

echo '<hr>';
echo '<p class="success">✅ Setup selesai! Hapus file deploy.php ini sekarang!</p>';
echo '<p><a href="/" style="color:#4fc1ff;">← Kembali ke TechNews</a></p>';
echo '</body></html>';
