<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
    	$user_id = User::all()->pluck('id')->toArray();

    	$topic_id = Topic::all()->pluck('id')->toArray();

    	$faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)->times(5000)->make()->each(function ($reply, $index) use ($user_id,$topic_id,$faker) {

        	$reply->user_id = $faker->randomElement($user_id);
        	$reply->topic_id = $faker->randomElement($topic_id);
            
        });

        Reply::insert($replys->toArray());
    }

}

