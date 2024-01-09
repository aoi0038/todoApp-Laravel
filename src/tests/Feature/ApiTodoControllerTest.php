<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Todo;
use App\Models\User;


class ApiTodoControllerTest extends TestCase
{
    /**
     * nameに関するテスト
     * Create時に正常にでリクエストしたら
     * ステータスコード200を返却すること
     */
    public function testValidAtCreate()
    {
      $user = User::factory()->create();
      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
        'description' => 'このTodoについての説明を書きます',
        'user_id' => $user->id,
        'category_id' => 1,
        'status_id' => 1,
      ];
      $response = $this->post('/api/todos', $itemdata);
      $response->assertStatus(200);
    }

    /**
     * nameに関するテスト
     * Create時に空文字でリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateBrankNameAtCreate()
    {
      $user = User::factory()->make();
      $this->actingAs($user);

      $itemdata = [
        'name' => '',
        'description' => 'このTodoについての説明を書きます',
      ];
      $response = $this->post('/api/todos', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * nameに関するテスト
     * Create時にNullでリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateNullNameAtCreate()
    {
      $user = User::factory()->make();
      $this->actingAs($user);

      $itemdata = [
        'name' => null,
        'description' => 'このTodoについての説明を書きます',
      ];
      $response = $this->post('/api/todos', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * nameに関するテスト
     * Create時にnameパラメータをリクエストしなかったら
     * ステータスコード400を返却すること
     */
    public function testValidateNotExistNameParamAtCreate()
    {
      $user = User::factory()->make();
      $this->actingAs($user);

      $itemdata = [
        'description' => 'このTodoについての説明を書きます',
      ];
      $response = $this->post('/api/todos', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * nameに関するテスト
     * Create時に文字列ではなかったら
     * ステータスコード400を返却すること
     */
    public function testInvalidNotStringNameAtCreate()
    {
      $user = User::factory()->make();
      $this->actingAs($user);

      $itemdata = [
        'name' => true,
        'description' => 'このTodoについての説明を書きます',
      ];
      $response = $this->post('/api/todos', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * descriptionに関するテスト
     * Create時に空文字でリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateBrankDescriptionAtCreate()
    {
      $user = User::factory()->make();
      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
        'description' => '',
      ];
      $response = $this->post('/api/todos', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * descriptionに関するテスト
     * Create時にNullでリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateNullDescriptionAtCreate()
    {
      $user = User::factory()->make();
      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
        'description' => null,
      ];
      $response = $this->post('/api/todos', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * descriptionに関するテスト
     * Create時にnameパラメータをリクエストしなかったら
     * ステータスコード400を返却すること
     */
    public function testValidateNotExistDescriptionParamAtCreate()
    {
      $user = User::factory()->make();
      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
      ];
      $response = $this->post('/api/todos', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * descriptionに関するテスト
     * Create時に文字列ではなかったら
     * ステータスコード400を返却すること
     */
    public function testInvalidNotStringDescriptionAtCreate()
    {
      $user = User::factory()->make();
      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
        'description' => true,
      ];
      $response = $this->post('/api/todos', $itemdata);
      $response->assertStatus(400);
    }
    /**
     * nameに関するテスト
     * Update時に正常にリクエストしたら
     * ステータスコード200を返却すること
     */
    public function testValidAtUpdate()
    {
      $user = User::factory()->create();
      $todo = Todo::factory()->create(['user_id' => $user->id]);
      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
        'description' => 'このTodoについての説明を書きます',
        'user_id' => $user->id,
        'category_id' => 1,
        'status_id' => 1,
      ];
      $response = $this->put('/api/todos/' . $todo->id, $itemdata);
      $response->assertStatus(200);
    }

    /**
     * nameに関するテスト
     * Update時に空文字でリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateBrankNameAtUpdate()
    {
      $user = User::factory()->create();
      $todo = Todo::factory()->create(['user_id' => $user->id]);

      $this->actingAs($user);

      $itemdata = [
        'name' => '',
        'description' => 'このTodoについての説明を書きます',
      ];
      $response = $this->put('/api/todos/' . $todo->id, $itemdata);
      $response->assertStatus(400);
    }

    /**
     * nameに関するテスト
     * Update時にNullでリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateNullNameAtUpdate()
    {
      $user = User::factory()->create();
      $todo = Todo::factory()->create(['user_id' => $user->id]);

      $this->actingAs($user);

      $itemdata = [
        'name' => null,
        'description' => 'このTodoについての説明を書きます',
      ];
      $response = $this->put('/api/todos/' . $todo->id, $itemdata);
      $response->assertStatus(400);
    }

    /**
     * nameに関するテスト
     * Update時にnameパラメータをリクエストしなかったら
     * ステータスコード400を返却すること
     */
    public function testValidateNotExistNameParamAtUpdate()
    {
      $user = User::factory()->create();
      $todo = Todo::factory()->create(['user_id' => $user->id]);

      $this->actingAs($user);

      $itemdata = [
        'description' => 'このTodoについての説明を書きます',
      ];
      $response = $this->put('/api/todos/' . $todo->id, $itemdata);
      $response->assertStatus(400);
    }

    /**
     * nameに関するテスト
     * Update時に文字列ではなかったら
     * ステータスコード400を返却すること
     */
    public function testInvalidNotStringNameAtUpdate()
    {
      $user = User::factory()->create();
      $todo = Todo::factory()->create(['user_id' => $user->id]);

      $this->actingAs($user);

      $itemdata = [
        'name' => true,
        'description' => 'このTodoについての説明を書きます',
      ];
      $response = $this->put('/api/todos/' . $todo->id, $itemdata);
      $response->assertStatus(400);
    }

    /**
     * descriptionに関するテスト
     * Update時に空文字でリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateBrankDescriptionAtUpdate()
    {
      $user = User::factory()->create();
      $todo = Todo::factory()->create(['user_id' => $user->id]);

      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
        'description' => '',
      ];
      $response = $this->put('/api/todos/' . $todo->id, $itemdata);
      $response->assertStatus(400);
    }

    /**
     * descriptionに関するテスト
     * Update時にNullでリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateNullDescriptionAtUpdate()
    {
      $user = User::factory()->create();
      $todo = Todo::factory()->create(['user_id' => $user->id]);

      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
        'description' => null,
      ];
      $response = $this->put('/api/todos/' . $todo->id, $itemdata);
      $response->assertStatus(400);
    }

    /**
     * descriptionに関するテスト
     * Update時にnameパラメータをリクエストしなかったら
     * ステータスコード400を返却すること
     */
    public function testValidateNotExistDescriptionParamAtUpdate()
    {
      $user = User::factory()->create();
      $todo = Todo::factory()->create(['user_id' => $user->id]);

      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
      ];
      $response = $this->put('/api/todos/' . $todo->id, $itemdata);
      $response->assertStatus(400);
    }

    /**
     * descriptionに関するテスト
     * Update時に文字列ではなかったら
     * ステータスコード400を返却すること
     */
    public function testInvalidNotStringDescriptionAtUpdate()
    {
      $user = User::factory()->create();
      $todo = Todo::factory()->create(['user_id' => $user->id]);

      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
        'description' => true,
      ];
      $response = $this->put('/api/todos/' . $todo->id, $itemdata);
      $response->assertStatus(400);
    }

}
