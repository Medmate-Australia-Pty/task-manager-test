<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\TasksRequest;
use App\Tasks;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        //
        $per_page = $req->input('per_page') ?? 10;
        $sort_by = $req->input('sort_by') ?: NULL;
        $sort_order = $req->input('sort_order') ?: NULL;
        $filter = $req->input('status') ?: NULL;

        $task = Tasks::where('user_id', auth()->user()->id);

        if($sort_by){
            $task->orderBy($sort_by, ($sort_order) ? $sort_order : 'ASC');
        }

        if($filter){
            if(!in_array($filter, config('task.status'))){
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid status filtering value.',
                    'data' => $filter,
                ], 422);
            }
            $task->where('status', $filter);
        }

        return response()->json([
            'success' => true,
            'message' => 'Retrieve tasks successfully.',
            'data' => $task->paginate($per_page),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Api\TasksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TasksRequest $request)
    {
        //
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;

        try {
            $task = Tasks::create($data);
     
             if($task){
                 return response()->json([
                     'success'   => true,
                     'message'   => 'Successfully created a task.',
                     'data'      => $task
                 ], 201);
             }
        } catch (\Throwable $th) {
            return response()->json([
                'success'   => false,
                'message'   => 'Something went wrong.',
                'data'      => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $task = Tasks::find($id);
        if($task){
            $task->update($request->all());
            return response()->json([
                'success'   => true,
                'message'   => 'Successfully updated a task.',
                'data'      => $task
            ], 204);
        }
        return response()->json([
            'success'   => false,
            'message'   => 'Task not found.',
            'data'      => $task
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Tasks::find($id);
        if($task){
            $task->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'Successfully deleted a task.',
                'data'      => $task
            ], 204);
        }
        return response()->json([
            'success'   => false,
            'message'   => 'Task not found.',
            'data'      => $task
        ], 404);
    }
}
