<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Sunset Sessions @ Pacha Madrid',
                'description' => 'Una noche épica en uno de los clubes más icónicos de Madrid. Ven a disfrutar de los mejores beats de techno y house en una atmósfera inigualable.',
                'event_date' => now()->addDays(7)->setTime(23, 0),
                'location' => 'Pacha Madrid, Calle Barceló, 11',
                'is_active' => true,
            ],
            [
                'title' => 'Underground Vibes @ Razzmatazz Barcelona',
                'description' => 'Especial set de 4 horas en la sala principal de Razzmatazz. Prepárate para un viaje sonoro inolvidable.',
                'event_date' => now()->addDays(14)->setTime(1, 0),
                'location' => 'Razzmatazz, Barcelona',
                'is_active' => true,
            ],
            [
                'title' => 'Beach Party @ Marbella',
                'description' => 'Sesión especial en la playa. Música, sol y buenas vibras. No te lo puedes perder.',
                'event_date' => now()->addDays(21)->setTime(18, 0),
                'location' => 'Nikki Beach, Marbella',
                'is_active' => true,
            ],
            [
                'title' => 'Festival Electronica Valencia',
                'description' => 'Participación especial en el festival más grande de música electrónica de Valencia.',
                'event_date' => now()->addDays(30)->setTime(20, 0),
                'location' => 'Ciudad de las Artes y las Ciencias, Valencia',
                'is_active' => true,
            ],
            [
                'title' => 'Warehouse Sessions @ Fabrik',
                'description' => 'Noche de techno puro en el templo de la música electrónica de Madrid.',
                'event_date' => now()->addDays(45)->setTime(23, 30),
                'location' => 'Fabrik, Madrid',
                'is_active' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
