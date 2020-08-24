<?php

namespace App\Http\Controllers;

use App\Folder; 
use App\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
    * GET /folders/{id}/tasks
    */
    public function index(int $id) 
    {
        //全てのフォルダデータをデータベースから取得 
        $folders = Folder::all();

        //選ばれたフォルダを取得
        $current_folder = Folder::find($id); 

        //選ばれたフォルダに紐づくタスクを取得
        $tasks = $current_folder->tasks()->get();

        return view('tasks/index', [ 
            'folders' => $folders,
            'current_folder_id' => $id, //idをcurrent_folder_idに渡す 
            'tasks' => $tasks,
            ]); 
    }

    /**
    * GET /folders/{id}/tasks/create
    */
    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    /**
     * GET /folders/{id}/tasks/{task_id}/edit
     */
    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        //リクエストされたIDで編集対象のタスクデータ取得
        $task = Task::find($task_id);

        //編集対象のタスクデータに入力値を詰めてsave
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        //編集対象尾のタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}