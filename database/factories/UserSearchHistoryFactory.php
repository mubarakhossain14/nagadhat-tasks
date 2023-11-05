<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSearchHistory>
 */
class UserSearchHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $keywords = [
            'Keyword 1',
            'Keyword 2',
            'Keyword 3',
        ];

        $results = [];

        $numOfResults = rand(1, 5);

        for ($i = 0; $i < $numOfResults; $i++) {
            $results[] = [
                'id' => fake()->uuid(),
                'title' => fake()->sentence,
                'link' => fake()->url,
            ];
        }

//        dd($results);

        return [
            'user_id' => fake()->numberBetween(1, User::all()->count()),
            'search_keyword' => $keywords[array_rand($keywords)],
            'search_time' => fake()->dateTimeBetween('-30 days', 'now'),
            'search_results' => json_encode($results),
        ];
    }
}
