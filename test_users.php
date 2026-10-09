<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
echo json_encode(DB::table('pengguna')->where('jabatan_status', 4)->get(), JSON_PRETTY_PRINT);
