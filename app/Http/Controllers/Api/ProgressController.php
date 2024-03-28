<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProgressRequest;
use App\Models\Progress;
use App\Services\ProgressService;

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
        return $this->sendResponse("user progress list",$progress);
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
            return $this->sendError(error:"this progress is not yours", code: 403);
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
        return $this->sendResponse(message:"progress updated successfully");
    }

    public function toggleStatus(Progress $progress)
    {
        $progress = $this->progressService->toggleStatus($progress);
        if(! $progress){
            return $this->sendError(error:"this progress is not yours",code: 403);
        }
        return $this->sendResponse(message: "status changes to ".$progress->status);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        $progress = $this->progressService->delete($progress);
        if(! $progress){
            return $this->sendError(error: "this progress is not yours",code: 403 );
        }
        return $this->sendResponse("progress deleted successfully");
    }
}
