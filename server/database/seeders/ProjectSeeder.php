<?php

namespace Database\Seeders;

use Bundles\Kanban\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    use Faker;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Project::query()->insert([
                'uuid'          => Str::uuid(),
                'code'          => "PRO-{$i}",
                'name'          => $this->getFaker()->company(),
                'owner_id'      => 1,
                'description'   => $this->getFaker()->paragraph(),
                'created_at'    => $this->getFaker()->dateTime(),
                'updated_at'    => $this->getFaker()->dateTime()
            ]);
        }
    }
}
