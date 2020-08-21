<?php

namespace App\Http\Controllers;

//クラスのインポート
use App\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        //フォーム画面を返す
        return view('folders/create');
    }

    //引数にインポートしたCreateFolderクラスを受け入れる
    public function create(CreateFolder $request)
    {
        //フォルダモデルのインスタンスを生成する
        $folder = new Folder();

        //タイトルに入力値を代入
        $folder->title = $request->title;

        //インスタンスの状態をデータベースに書き込む
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
