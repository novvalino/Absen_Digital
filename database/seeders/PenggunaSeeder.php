<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        $pengguna = [
            [
                'nomor_induk' => '0',
                'nama' => 'Nusabot.id',
                'tag' => '',
                'jabatan_status' => 1,
                'cabang_gedung' => 0,
                'password' => '$2y$12$MDwJSBNRR0b.8B3HIlsOB.ZGk5Bx9CU8yw6AY7g1VuA8T0lYMPAjW',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => '0111111',
                'nama' => 'Tegar',
                'tag' => '11223344',
                'jabatan_status' => 2,
                'cabang_gedung' => 3,
                'password' => '9549d400a68633435918290085f06293',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => '0987654',
                'nama' => 'putri',
                'tag' => '0987654',
                'jabatan_status' => 8,
                'cabang_gedung' => 2,
                'password' => '$2y$12$evEqBcOF3eHmzmRStOnX1O9Cmvei7BcTPNU18EeiEo4TmKYgFsLF.',
                  'aktif' => '1',
            ],
            [
                'nomor_induk' => '1',
                'nama' => 'pratama fahriel sanjaya',
                'tag' => '73cba8aa',
                'jabatan_status' => 2,
                'cabang_gedung' => 1,
                'password' => 'c4ca4238a0b923820dcc509a6f75849b',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => '12228418',
                'nama' => 'Muhammad Bintoro',
                'tag' => '79603bd5',
                'jabatan_status' => 2,
                'cabang_gedung' => 1,
                'password' => '2a372a408d5d7f2ddc30142b9fdc2563',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => '123',
                'nama' => 'hasta',
                'tag' => '3755fe',
                'jabatan_status' => 3,
                'cabang_gedung' => 1,
                'password' => '827ccb0eea8a706c4c34a16891f84e7a',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => '12329252',
                'nama' => 'Nuril Jannatii',
                'tag' => 'accf6905',
                'jabatan_status' => 3,
                'cabang_gedung' => 1,
                'password' => '7a7a52fcbfa494a96604d4b2ddba79ec',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => '1234',
                'nama' => 'Fauzan Azhiman',
                'tag' => 'e3dbfbb6',
                'jabatan_status' => 5,
                'cabang_gedung' => 1,
                'password' => '81dc9bdb52d04dc20036dbd8313ed055',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => '12430139',
                'nama' => 'Novvalino',
                'tag' => '999999',
                'jabatan_status' => 2,
                'cabang_gedung' => 3,
                'password' => '$2y$12$P8SZLcwwAeB7KIQkdugsT.cKFPHiTBshfh.QEjqVl6orjePDDfZcy',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => '234556',
                'nama' => 'riza',
                'tag' => '234556',
                'jabatan_status' => 7,
                'cabang_gedung' => 1,
                'password' => '$2y$12$Kf1NIljvltbfWTG6pZtGjO2kHJa1Encu7fGYjCS6r/lUndMTIK6aq',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => '23456',
                'nama' => 'Boya Rizky Agung',
                'tag' => '98756fg',
                'jabatan_status' => 7,
                'cabang_gedung' => 2,
                'password' => 'adcaec3805aa912c0d0b14a81bedb6ff',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => '8888',
                'nama' => 'Novvalino',
                'tag' => 'admin',
                'jabatan_status' => 2,
                'cabang_gedung' => 1,
                'password' => '$2y$12$ykgs8fCAGHvF8zADvZrZuuz5/6.bkaQIXN9K/vOkBL/1pJn9PJnmO',
                'aktif' => '1',
            ],
            [
                'nomor_induk' => 'admin@sekolah.local',
                'nama' => 'novval',
                'tag' => '123',
                'jabatan_status' => 2,
                'cabang_gedung' => 1,
                'password' => '$2y$12$.IC/88R..Fw0/Lo7mzh8ve9.QpaCVF.4AQio/jRzgxRPMemp.pT/m',
                'aktif' => '1',
            ],
        ];

        foreach ($pengguna as $data) {
            DB::table('pengguna')->updateOrInsert(
                ['nomor_induk' => $data['nomor_induk']],
                $data
            );
        }
    }
}

