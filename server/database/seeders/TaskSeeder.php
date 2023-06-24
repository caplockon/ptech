<?php

namespace Database\Seeders;

use Bundles\Kanban\Models\Priority;
use Bundles\Kanban\Models\Status;
use Bundles\Kanban\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    use Faker;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectId = 8;
        $priorities = Priority::query()->where('project_id', $projectId)->pluck('id')->all();
        $statuses = Status::query()->where('project_id', $projectId)->pluck('id')->all();

        for ($i = 0; $i < 20; $i++) {
            Task::query()->insert([
                'uuid'          => $this->getFaker()->uuid(),
                'name'          => $this->getFaker()->sentence(),
                'description'   => $this->getFaker()->paragraph(),
                'project_id'    => $projectId,
                'creator_id'    => 1,
                'assignee_id'   => 1,
                'status_id'     => $this->getFaker()->randomElement($statuses),
                'priority_id'   => $this->getFaker()->randomElement($priorities),
                'created_at'    => $this->getFaker()->dateTime(),
                'updated_at'    => $this->getFaker()->dateTime(),
            ]);
        }
    }
}
