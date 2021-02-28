<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserReview;

class UserReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserReview::factory(10)->create();
        $this->command->info('User Reviews añadidas correctamente');
    }
}
