<?php

namespace Tests\Feature;

use App\Http\Requests\CreateTask;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use WituoutMiddleware;

class TaskTest extends TestCase
{
    // テストケースごとにデータベースをリフレッシュして
    // マイグレーションを再実行する
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // テストケース実行前にフォルダデータを作成する
        $this->seed('FoldersTableSeeder');
    }

    /**
     * 期限日が日付ではない場合はバリデーションに失敗する
     * @test
     */
    public function due_date_should_be_date()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => 123,
        ]);

        $response->assertSessionHasErrors([
            'due_date',
        ]);
    }

    /**
     * 期限日が過去日付の場合はバリデーションに失敗する
     * @test
     */
    public function due_date_should_not_be_past()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => Carbon::yesterday()->format('Y/m/d'),
        ]);

        $response->assertSessionHasErrors([
            'due_date',
        ]);
    }

    /**
     * 状態が定義された値ではない場合はバリデーションエラー
     * @test
     */
    public function status_should_be_within_defined_numbers(){
        $this->seed('TasksTableSeeder');

        $response = $this->post('/folders/1/tasks/1/edit', [
            'title' => 'Sample task',
            'due_date' => Carbon::today()->format('Y/m/d'),
            'status' => 999,
        ]);

        $response->assertSessionHasErrors([
            'status',
        ]);
    }
}