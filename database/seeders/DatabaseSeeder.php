<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Issue;
use App\Models\Label;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // إنشاء مستخدمين مع أدوار مختلفة
        User::factory(10)->create();

        // إنشاء مشاريع
        $projects = Project::factory(5)->create();

        // إنشاء Labels
        $labels = Label::factory(10)->create();

        // إنشاء Issues لكل مشروع
        foreach ($projects as $project) {
            $issues = Issue::factory(5)->for($project)->create([
                'reporter_id' => User::all()->random()->id,
                'assignee_id' => User::all()->random()->id,
            ]);

            foreach ($issues as $issue) {
                // ربط Labels عشوائي لكل Issue
                $issue->labels()->attach(
                    $labels->random(rand(1, 3))->pluck('id')->toArray()
                );

                // إضافة بعض التعليقات لكل Issue
                $issue->comments()->createMany(
                    User::all()->random(rand(1, 3))->map(function ($user) {
                        return [
                            'user_id' => $user->id,
                            'content' => fake()->sentence,
                        ];
                    })->toArray()
                );
            }
        }
    }
}
