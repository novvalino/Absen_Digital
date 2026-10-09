<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = App\Models\User::where('nomor_induk', 'ORTU001')->first();
echo "Real User: {$user->nomor_induk} with jabatan_status {$user->jabatan_status}\n";

// simulate login
Auth::login($user);
$loggedInUser = Auth::user();

echo "Logged In User: {$loggedInUser->nomor_induk} with jabatan_status {$loggedInUser->jabatan_status}\n";
echo "JabatanStatus: {$loggedInUser->jabatanStatus->jabatan_status}\n";
echo "HakAkses: {$loggedInUser->jabatanStatus->hakAkses->hak}\n";
