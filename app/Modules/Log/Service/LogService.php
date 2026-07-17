<?php

namespace App\Modules\Log\Service;

use App\Modules\Log\Dto\LogData;
use App\Modules\Log\Dto\LogFilterData;
use App\Modules\Log\Dto\LogListResult;
use App\Modules\Log\Factory\LogFactory;
use App\Modules\Log\Models\Log;
use App\Modules\Log\Repository\LogRepository;
use App\Modules\User\Models\User;

class LogService
{
    public function __construct(
        private readonly LogRepository $repository,
        private readonly LogFactory $factory,
    ) {}

    public function list(LogFilterData $filter): LogListResult
    {
        return new LogListResult(
            logs: $this->repository->paginateForUser($filter),
            timeTotal: $this->repository->sumTimeForUser($filter),
        );
    }

    public function create(User $user, LogData $data): Log
    {
        $log = $this->factory->make($user, $data);
        $this->repository->save($log);

        return $log;
    }

    public function update(Log $log, LogData $data): void
    {
        $log->fill([
            'project_id' => $data->projectId,
            'text' => $data->text,
            'link' => $data->link,
            'time' => $data->time,
            'date' => $data->date,
        ]);

        $this->repository->save($log);
    }

    public function delete(Log $log): void
    {
        $this->repository->delete($log);
    }
}
