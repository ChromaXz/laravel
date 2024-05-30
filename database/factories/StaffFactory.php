<?php
//dibuat dengan code: php artisan make:factory StaffFactory
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Staff;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    protected $model = Staff::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nip' => fake()->unique()->numerify(),
            'name' => fake()->name(),
            'alamat' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
//memasukkan ke database table staff: php artisan db:seed --class=StaffSeeder
//memasukkan ke database keseluruhan: php artisan db:seed
