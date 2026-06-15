<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resort;

class ResortCoordinatesSeeder extends Seeder
{
    public function run(): void
    {
        $coordinates = [
            'Chamonix Mont-Blanc' => [45.9237, 6.8694],
            'Courchevel' => [45.4153, 6.6367],
            'Zermatt' => [46.0207, 7.7491],
            'Verbier' => [46.0965, 7.2286],
            'St. Anton am Arlberg' => [47.1292, 10.2682],
            'Kitzbühel' => [47.4464, 12.3922],
            'Cortina d’Ampezzo' => [46.5405, 12.1357],
            'Livigno' => [46.5383, 10.1351],
            'Trysil' => [61.3076, 12.2430],
            'Åre' => [63.3990, 13.0810],
            'Garmisch-Partenkirchen' => [47.4917, 11.0955],
            'Grandvalira' => [42.5424, 1.7336],
        ];

        foreach ($coordinates as $name => [$latitude, $longitude]) {
            Resort::where('name', $name)->update([
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        }
    }
}