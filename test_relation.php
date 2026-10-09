<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::where('nomor_induk', 'ORTU001')->first();
$jabatanStatus = $user->jabatanStatus;
$hakAkses = $jabatanStatus->hakAkses;

echo "User ID: " . $user->nomor_induk . "\n";
echo "Jabatan Status Rel: " . json_encode($jabatanStatus) . "\n";
echo "Hak Akses Rel: " . json_encode($hakAkses) . "\n";
