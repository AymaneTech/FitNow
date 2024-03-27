<?php

namespace App\Contracts;

use App\Models\Progress;

interface ServiceInterface
{
    public function get();

    public function store(array $data): void;

    public function show(Progress $progress);

    public function update(array $data, Progress $progress);

    public function delete(Progress $progress);

}
