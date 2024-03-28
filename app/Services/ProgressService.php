<?php

namespace App\Services;

use App\Contracts\ServiceInterface;
use App\Enums\Status;
use App\Http\Resources\ProgressResource;
use App\Models\Progress;

class ProgressService implements ServiceInterface
{
    public function get()
    {
        $progress = Progress::UserProgress();
        return ProgressResource::collection($progress);
    }

    public function show(Progress $progress)
    {
        $this->isHisProgress($progress->user_id);
        return (new ProgressResource($progress));
    }

    public function store(array $data): void
    {
        $data["performance"] = json_encode($data["performance"]);
        $data["measurements"] = json_encode($data["measurements"]);
        Progress::create($data);
    }

    public function update(array $data, Progress $progress)
    {
        $progress->update($data);
    }

    public function delete(Progress $progress)
    {
        $this->isHisProgress($progress->user_id);
        $progress->delete();
        return true;
    }

    public function toggleStatus(Progress $progress)
    {
        $this->isHisProgress($progress->user_id);

        $progress->status = Status::COMPLETED->value;
        $progress->save();

        return $progress;
    }

    private function isHisProgress($id)
    {
        if ($id !== auth("sanctum")->id()) {
            return false;
        }
    }
}

