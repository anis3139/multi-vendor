<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubAdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Rofiqul Islam',
            'email' => 'rofiqulislam1952@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('rofiqulislam1952'), // password
            'remember_token' => Str::random(10),
        ];
    }
}
