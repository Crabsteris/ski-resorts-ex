<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Resort;

class ResortSeeder extends Seeder
{
    public function run(): void
    {
        $resorts = [
            [
                'country' => 'France',
                'name' => 'Chamonix Mont-Blanc',
                'description' => 'One of the most famous ski destinations in Europe, known for dramatic alpine scenery, challenging terrain, and access to high mountain routes.',
            ],
            [
                'country' => 'France',
                'name' => 'Courchevel',
                'description' => 'A premium ski resort in Les Trois Vallées, offering wide slopes, luxury accommodation, modern lifts, and excellent restaurants.',
            ],
            [
                'country' => 'Switzerland',
                'name' => 'Zermatt',
                'description' => 'A beautiful Swiss resort located near the Matterhorn, famous for long ski runs, glacier skiing, and scenic mountain views.',
            ],
            [
                'country' => 'Switzerland',
                'name' => 'Verbier',
                'description' => 'A popular resort for advanced skiers and freeride enthusiasts, with varied terrain, lively après-ski, and impressive alpine scenery.',
            ],
            [
                'country' => 'Austria',
                'name' => 'St. Anton am Arlberg',
                'description' => 'A legendary Austrian ski resort known for deep snow, challenging slopes, and one of the strongest après-ski scenes in the Alps.',
            ],
            [
                'country' => 'Austria',
                'name' => 'Kitzbühel',
                'description' => 'A historic ski town with charming streets, varied pistes, and the famous Hahnenkamm downhill race course.',
            ],
            [
                'country' => 'Italy',
                'name' => 'Cortina d’Ampezzo',
                'description' => 'A stylish resort in the Dolomites with stunning mountain views, sunny slopes, and a strong Italian alpine atmosphere.',
            ],
            [
                'country' => 'Italy',
                'name' => 'Livigno',
                'description' => 'A high-altitude Italian resort with reliable snow, duty-free shopping, snow parks, and slopes suitable for different skill levels.',
            ],
            [
                'country' => 'Norway',
                'name' => 'Trysil',
                'description' => 'Norway’s largest ski resort, offering family-friendly slopes, reliable snow conditions, and a calm Scandinavian winter atmosphere.',
            ],
            [
                'country' => 'Sweden',
                'name' => 'Åre',
                'description' => 'A popular Scandinavian ski resort with a mix of alpine skiing, winter activities, restaurants, and beautiful northern landscapes.',
            ],
            [
                'country' => 'Germany',
                'name' => 'Garmisch-Partenkirchen',
                'description' => 'A classic German ski destination near the Zugspitze, offering alpine views, traditional Bavarian charm, and varied winter activities.',
            ],
            [
                'country' => 'Andorra',
                'name' => 'Grandvalira',
                'description' => 'One of the largest ski areas in the Pyrenees, offering many connected slopes, modern lift systems, and good value for visitors.',
            ],
        ];

        foreach ($resorts as $resortData) {
            $country = Country::firstOrCreate([
                'name' => $resortData['country'],
            ]);

            Resort::updateOrCreate(
                ['name' => $resortData['name']],
                [
                    'country_id' => $country->id,
                    'description' => $resortData['description'],
                    'image' => null,
                ]
            );
        }
    }
}