<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;

class ApiCategoryControllerTest extends TestCase
{
    /**
     * nameに関するテスト
     * Create時に正常にでリクエストしたら
     * ステータスコード200を返却すること
     */
    public function testValidAtCreate()
    {
      $user = User::factory()->make();
      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
      ];
      $response = $this->post('/api/categories', $itemdata);
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
      ];
      $response = $this->post('/api/categories', $itemdata);
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
      ];
      $response = $this->post('/api/categories', $itemdata);
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

      $itemdata = [];
      $response = $this->post('/api/categories', $itemdata);
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
      ];
      $response = $this->post('/api/categories', $itemdata);
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
      $this->actingAs($user);

      $itemdata = [
        'name' => 'このTodoについての名前を書きます',
      ];
      $response = $this->put('/api/categories/1', $itemdata);
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
      $this->actingAs($user);

      $itemdata = [
        'name' => '',
      ];
      $response = $this->put('/api/todos/1', $itemdata);
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
      $this->actingAs($user);

      $itemdata = [
        'name' => null,
      ];
      $response = $this->put('/api/todos/1', $itemdata);
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
      $this->actingAs($user);

      $itemdata = [];
      $response = $this->put('/api/todos/1', $itemdata);
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
      $this->actingAs($user);

      $itemdata = [
        'name' => true,
      ];
      $response = $this->put('/api/todos/1', $itemdata);
      $response->assertStatus(400);
    }
}
