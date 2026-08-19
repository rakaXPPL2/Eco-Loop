<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            [
                'name' => 'Jakarta Pusat',
                'slug' => 'jakarta-pusat',
                'province' => 'DKI Jakarta',
                'city' => 'Jakarta Pusat',
                'district' => 'Gambir',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
            ],
            [
                'name' => 'Jakarta Selatan',
                'slug' => 'jakarta-selatan',
                'province' => 'DKI Jakarta',
                'city' => 'Jakarta Selatan',
                'district' => 'Kebayoran Baru',
                'latitude' => -6.2615,
                'longitude' => 106.8112,
            ],
            [
                'name' => 'Jakarta Barat',
                'slug' => 'jakarta-barat',
                'province' => 'DKI Jakarta',
                'city' => 'Jakarta Barat',
                'district' => 'Grogol Petamburan',
                'latitude' => -6.1554,
                'longitude' => 106.7506,
            ],
            [
                'name' => 'Jakarta Timur',
                'slug' => 'jakarta-timur',
                'province' => 'DKI Jakarta',
                'city' => 'Jakarta Timur',
                'district' => 'Cipayung',
                'latitude' => -6.2250,
                'longitude' => 106.9015,
            ],
            [
                'name' => 'Jakarta Utara',
                'slug' => 'jakarta-utara',
                'province' => 'DKI Jakarta',
                'city' => 'Jakarta Utara',
                'district' => 'Koja',
                'latitude' => -6.1393,
                'longitude' => 106.8819,
            ],
            [
                'name' => 'Bandung',
                'slug' => 'bandung',
                'province' => 'Jawa Barat',
                'city' => 'Bandung',
                'district' => 'Bandung Wetan',
                'latitude' => -6.9147,
                'longitude' => 107.6098,
            ],
            [
                'name' => 'Surabaya Pusat',
                'slug' => 'surabaya-pusat',
                'province' => 'Jawa Timur',
                'city' => 'Surabaya',
                'district' => 'Genteng',
                'latitude' => -7.2496,
                'longitude' => 112.7508,
            ],
            [
                'name' => 'Surabaya Utara',
                'slug' => 'surabaya-utara',
                'province' => 'Jawa Timur',
                'city' => 'Surabaya',
                'district' => 'Bulak',
                'latitude' => -7.2275,
                'longitude' => 112.7324,
            ],
            [
                'name' => 'Medan',
                'slug' => 'medan',
                'province' => 'Sumatera Utara',
                'city' => 'Medan',
                'district' => 'Medan Kota',
                'latitude' => 3.5881,
                'longitude' => 98.6732,
            ],
            [
                'name' => 'Makassar',
                'slug' => 'makassar',
                'province' => 'Sulawesi Selatan',
                'city' => 'Makassar',
                'district' => 'Makassar',
                'latitude' => -5.1422,
                'longitude' => 119.4126,
            ],
            [
                'name' => 'Yogyakarta',
                'slug' => 'yogyakarta',
                'province' => 'DI Yogyakarta',
                'city' => 'Yogyakarta',
                'district' => 'Gedong Tengen',
                'latitude' => -7.7972,
                'longitude' => 110.3617,
            ],
            [
                'name' => 'Semarang',
                'slug' => 'semarang',
                'province' => 'Jawa Tengah',
                'city' => 'Semarang',
                'district' => 'Semarang Tengah',
                'latitude' => -6.9685,
                'longitude' => 110.4206,
            ],
        ];

        foreach ($regions as $region) {
            Region::firstOrCreate(
                ['slug' => $region['slug']],
                $region
            );
        }
    }
}
