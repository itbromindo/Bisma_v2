<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Penduduk;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penduduk>
 */
class PendudukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Penduduk::class;

    public function definition(): array
    {
        return [
            'penNik' => $this->faker->unique()->numerify('################'),
            'penNama' => $this->faker->name,
            'penTempatLahir' => $this->faker->city,
            'penTglLahir' => $this->faker->date,
            'penImage' => ''
        ];
    }
}
