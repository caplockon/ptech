<?php

namespace Database\Seeders;

use App\Models\Kanban\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectStatusSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::query()->insert([
            'uuid'          => Str::uuid(),
            'status'        => 'To Do',
            'priority'      => 1,
            'project_id'    => 0,
        ]);

        Status::query()->insert([
            'uuid'          => Str::uuid(),
            'status'        => 'In Progress',
            'priority'      => 2,
            'project_id'    => 0,
        ]);

        Status::query()->insert([
            'uuid'          => Str::uuid(),
            'status'        => 'Done',
            'priority'      => 3,
            'project_id'    => 0,
        ]);
    }
}
