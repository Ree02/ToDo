<?php

namespace App\Http\Controllers;

use App\Folder; 
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id) /*引数はルーティングで定義した波括弧内の値(今回は{id})と同じでなければならない*/
    {
        $folders = Folder::all();/*folderモデルのallクラスメソッドで全てのフォルダデータをデータベースから取得 */

        $current_folder = Folder::find($id); /*選ばれたフォルダを取得 */

        $tasks = Task::where('folder_id', $current_folder->id)->get();/*選ばれたフォルダに紐づくタスクを取得 */

        return view('tasks/index', [ /*view(テンプレートファイル名, テンプレートに渡すデータ) */
            'folders' => $folders,
            'current_folder_id' => $id, /*idをcurrent_folder_idに渡す */
            'tasks' => $tasks,
            ]); 
    }
}