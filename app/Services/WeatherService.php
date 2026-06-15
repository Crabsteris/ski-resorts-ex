<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public static function getCurrentWeather($latitude, $longitude): ?array
    {
        if ($latitude === null || $longitude === null) {
            return null;
        }

        try {
            $response = Http::timeout(5)
                ->retry(1, 200)
                ->get('https://api.open-meteo.com/v1/forecast', [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'current' => 'temperature_2m,relative_humidity_2m,precipitation,wind_speed_10m,weather_code',
                    'timezone' => 'auto',
                ]);

            if (! $response->successful()) {
                return null;
            }

            $data = $response->json();

            if (! isset($data['current'])) {
                return null;
            }

            $current = $data['current'];
            $units = $data['current_units'] ?? [];

            return [
                'temperature' => $current['temperature_2m'] ?? null,
                'temperature_unit' => $units['temperature_2m'] ?? '°C',

                'humidity' => $current['relative_humidity_2m'] ?? null,
                'humidity_unit' => $units['relative_humidity_2m'] ?? '%',

                'precipitation' => $current['precipitation'] ?? null,
                'precipitation_unit' => $units['precipitation'] ?? 'mm',

                'wind_speed' => $current['wind_speed_10m'] ?? null,
                'wind_speed_unit' => $units['wind_speed_10m'] ?? 'km/h',

                'weather_code' => $current['weather_code'] ?? null,
                'description' => self::weatherDescription($current['weather_code'] ?? null),

                'time' => $current['time'] ?? null,
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }

    private static function weatherDescription(?int $code): string
    {
        return match ($code) {
            0 => 'Clear sky',
            1 => 'Mainly clear',
            2 => 'Partly cloudy',
            3 => 'Overcast',
            45, 48 => 'Fog',
            51, 53, 55 => 'Drizzle',
            56, 57 => 'Freezing drizzle',
            61, 63, 65 => 'Rain',
            66, 67 => 'Freezing rain',
            71, 73, 75 => 'Snowfall',
            77 => 'Snow grains',
            80, 81, 82 => 'Rain showers',
            85, 86 => 'Snow showers',
            95 => 'Thunderstorm',
            96, 99 => 'Thunderstorm with hail',
            default => 'Weather data available',
        };
    }
}