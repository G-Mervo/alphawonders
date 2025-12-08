<?php
/**
 * Quick Cache Clear Script for Development
 * 
 * Run this script to clear CI4 cache and sessions:
 * php clear_cache.php
 */

$cacheDir = __DIR__ . '/writable/cache';
$sessionDir = __DIR__ . '/writable/session';

function deleteDir($dir) {
    if (!is_dir($dir)) {
        return;
    }
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? deleteDir($path) : unlink($path);
    }
    rmdir($dir);
}

echo "Clearing CI4 cache...\n";

// Clear cache directory
if (is_dir($cacheDir)) {
    deleteDir($cacheDir);
    mkdir($cacheDir, 0777, true);
    file_put_contents($cacheDir . '/index.html', '');
    echo "✓ Cache directory cleared\n";
}

// Clear session directory
if (is_dir($sessionDir)) {
    deleteDir($sessionDir);
    mkdir($sessionDir, 0777, true);
    file_put_contents($sessionDir . '/index.html', '');
    echo "✓ Session directory cleared\n";
}

echo "\nCache cleared successfully!\n";
echo "Now refresh your browser (Ctrl+Shift+R for hard refresh)\n";

