<?php

namespace App\Modules\Project\Factory;

use App\Modules\Project\Dto\ProjectData;
use App\Modules\Project\Models\Project;

class ProjectFactory
{
    public function make(ProjectData $data): Project
    {
        return new Project([
            'name' => $data->name,
            'status' => Project::STATUS_ACTIVE,
        ]);
    }
}
