<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
    	$user_id = User::all()->pluck('id')->toArray();

    	$category_id = Category::all()->pluck('id')->toArray();

    	$faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)->times(500)->make()->each(function ($topic, $index) use ($user_id,$category_id,$faker) {
            
            $topic->user_id = $faker->randomElement($user_id);

            $topic->category_id = $faker->randomElement($category_id);
        });

        Topic::insert($topics->toArray());
    }

}

