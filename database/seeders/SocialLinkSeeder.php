<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialLinks = [
            [
                'platform' => 'Instagram',
                'url' => 'https://instagram.com/javilabarumdj',
                'icon' => 'fab fa-instagram',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'platform' => 'Spotify',
                'url' => 'https://open.spotify.com/artist/javilabarumdj',
                'icon' => 'fab fa-spotify',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'platform' => 'SoundCloud',
                'url' => 'https://soundcloud.com/javilabarumdj',
                'icon' => 'fab fa-soundcloud',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'platform' => 'Facebook',
                'url' => 'https://facebook.com/javilabarumdj',
                'icon' => 'fab fa-facebook',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'platform' => 'YouTube',
                'url' => 'https://youtube.com/@javilabarumdj',
                'icon' => 'fab fa-youtube',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'platform' => 'TikTok',
                'url' => 'https://tiktok.com/@javilabarumdj',
                'icon' => 'fab fa-tiktok',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'platform' => 'Mixcloud',
                'url' => 'https://mixcloud.com/javilabarumdj',
                'icon' => 'fab fa-mixcloud',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'platform' => 'WhatsApp',
                'url' => 'https://wa.me/34600000000',
                'icon' => 'fab fa-whatsapp',
                'is_active' => true,
                'order' => 8,
            ],
        ];

        foreach ($socialLinks as $link) {
            SocialLink::create($link);
        }
    }
}
