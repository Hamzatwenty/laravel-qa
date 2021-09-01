<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersQuestionsAnswersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        DB::table('users')->delete();
        \App\Models\User::factory(200)->create()->each(function ($u){
            $u->questions()
                ->saveMany(Question::factory(rand(1,5))->make()
                )->each(function($q){
                    $q->answers()->saveMany(Answer::factory(rand(1,5))->make());
                });
        });
    }
}
