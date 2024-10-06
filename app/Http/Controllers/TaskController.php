<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view("/tasks.index", compact("tasks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $users = User::all();
        $projects = Project::all();
        return view("tasks.create", compact("users","projects"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'completed' => 'required|boolean',
            'userId' => 'required|exists:users,id',
            'projectId' => 'required|exists:projects,id',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->completed,
            'user_id' => $request->userId,
            'project_id' => $request->projectId, 
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);
        $users = User::all();
        $projects = Project::all();
        if ($task && $users->count() > 0) {
            return view('tasks.update', compact('task', 'users','projects'));
        } else {
            return redirect()->route('tasks.index')->with('error', 'Task does not exist.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'completed' => 'required|boolean',
            'userId' => 'required|exists:users,id',
            'projectId' => 'required|exists:projects,id',
        ]);

        $task = Task::find($id);


        if ($task) {
            $task->title = $request->title;
            $task->description = $request->description;
            $task->completed = $request->completed;
            $task->user_id = $request->userId;
            $task->project_id = $request->projectId;
            $task->save();

            return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Task does not exist.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();

            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
        } else {
            return redirect()->route('tasks.index')->with('error', 'Task does not exist.');
        }
    }

    public function filter(Request $request)
    {
        // Khởi tạo query builder để lọc task
        $tasks = Task::query();

        // Lọc theo tiêu đề (nếu có nhập vào)
        if ($request->has('filterTitle') && !empty($request->filterTitle)) {
            $tasks->where('title', 'LIKE', '%' . $request->filterTitle . '%');
        }

        // Lọc theo trạng thái (nếu có chọn trạng thái)
        if ($request->has('filterStatus') && $request->filterStatus !== '') {
            $tasks->where('completed', $request->filterStatus);
        }

        // Lấy kết quả sau khi áp dụng các bộ lọc
        $tasks = $tasks->get();

        // Trả về view kèm theo danh sách các task đã được lọc
        return view('tasks.index', compact('tasks'));
    }


}
