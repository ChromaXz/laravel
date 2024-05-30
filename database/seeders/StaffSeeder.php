<?php
//dibuat file ini dengan code: php artisan make:seeder StaffSeeder
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff; //dibuat sesuai yang ada di file models

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::factory(15)->create();
    }
}
//mengirim ke database mysql: php artisan db:seed
