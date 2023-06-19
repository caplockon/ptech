<?php

namespace Database\Seeders;

use App\Models\Kanban\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectPrioritySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::query()->insert([
            'uuid'          => Str::uuid(),
            'name'          => 'High',
            'project_id'    => 0,
            'order'         => 1,
        ]);

        Priority::query()->insert([
            'uuid'          => Str::uuid(),
            'name'          => 'Medium',
            'project_id'    => 0,
            'order'         => 2,
        ]);

        Priority::query()->insert([
            'uuid'          => Str::uuid(),
            'name'          => 'Low',
            'project_id'    => 0,
            'order'         => 3,
        ]);
    }
}
