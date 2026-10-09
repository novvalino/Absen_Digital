<?php
$files = glob('database/migrations/2026_02_06_*.php');
foreach($files as $file) {
    $content = file_get_contents($file);
    if(preg_match('/Schema::create\(\s*\'([^\']+)\'/', $content, $matches)) {
        $table = $matches[1];
        if(!str_contains($content, 'Schema::hasTable')) {
            $content = preg_replace('/(Schema::create\(\s*\'[^\']+\'\s*,\s*function\s*\([^\)]+\)\s*\{.*?\}\s*\);)/s', "if (!Schema::hasTable('$table')) {\n            $1\n        }", $content);
            file_put_contents($file, $content);
            echo "Updated $table in $file\n";
        }
    }
}
echo "Done.\n";
