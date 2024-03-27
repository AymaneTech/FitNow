<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgressRequest;
use App\Http\Resources\ProgressResource;
use App\Models\Progress;
use App\Services\ProgressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class ProgressController extends BaseController
{
    public function __construct(public ProgressService $progressService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progress = $this->progressService->get();
        return $this->sendResponse($progress, "user progress list");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgressRequest $request)
    {
        $validatedData =  $request->validated();
        $validatedData += ["user_id" => auth('sanctum')->id()];
         $this->progressService->store($validatedData);

        return $this->sendResponse("Progress Created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Progress $progress)
    {
        $progress = $this->progressService->show($progress);
        if(! $progress){
            return $this->sendError("this progress is not yours");
        }
        return $this->sendResponse($progress, "success");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProgressRequest $request, Progress $progress)
    {
        $validatedData =  $request->validated();
        $this->progressService->update($validatedData, $progress);
        return $this->sendResponse("progress updated successfully");
    }

    public function toggleStatus(Progress $progress)
    {
        $progress = $this->progressService->toggleStatus($progress);
        if(! $progress){
            return $this->sendError("this progress is not yours");
        }
        return $this->sendResponse("status changes to ".$progress->status);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        $progress = $this->progressService->delete($progress);
        if(! $progress){
            return $this->sendError("this progress is not yours");
        }
        return $this->sendResponse("progress deleted successfully");
    }
}
