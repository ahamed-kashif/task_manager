<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AxiosController extends Controller
{
    use ApiResponse;
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * tasks are fetched here
     * @return JsonResponse
     */
    public function fetchTasks($slug): \Illuminate\Http\JsonResponse
    {
        try {
            $project = Project::where('slug',$slug)->firstOrFail();
            $data = TaskResource::collection($project->tasks()->orderBy('priority','asc')->get());
            return $this->successResponse($data,200,$project->title.'\'s tasks are fetched');
        }catch (\Exception $e){
            return $this->errorResponse(500,$e->getMessage(),$e->getTrace());
        }
    }
    public function updateTaskPriority(Request $request){
        try{
            $cleanData = $request->validate([
                'list' => 'required|array',
            ]);
            foreach ($cleanData['list'] as $cat){
                $ogCat = Task::findOrFail($cat['id']);
                if($ogCat){
                    $ogCat->update([
                        'priority' => $cat['priority']
                    ]);
                }
            }
            return $this->successResponse([],200,'tasks order update');
        }catch (\Exception $e){
            return $this->errorResponse(500,$e->getMessage(),$e->getTrace());
        }
    }
}
