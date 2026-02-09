<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Javi La Barum',
            'email' => 'admin@javilabarumdj.com',
            'password' => Hash::make('password'), // Cambia esto en producción!
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Usuario administrador creado:');
        $this->command->info('   Email: admin@javilabarumdj.com');
        $this->command->info('   Password: password');
        $this->command->warn('   ⚠️  IMPORTANTE: Cambia la contraseña después del primer login!');
    }
}
