<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    /**
     * nameに関するテスト
     * 空文字でリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateBrankName()
    {
      $itemdata = [
        'name' => '',
        'email' => 'hogehoge@example.com',
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * nameに関するテスト
     * Nullでリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateNullName()
    {
      $itemdata = [
        'name' => null,
        'email' => 'hogehoge@example.com',
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * nameに関するテスト
     * nameパラメータをリクエストしなかったら
     * ステータスコード400を返却すること
     */
    public function testValidateNotExistNameParam()
    {
      $itemdata = [
        'email' => 'hogehoge@example.com',
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * nameに関するテスト
     * 文字列ではなかったら
     * ステータスコード400を返却すること
     */
    public function testInvalidNotStringName()
    {
      $itemdata = [
        'name' => true,
        'email' => 'hogehoge@example.com',
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * nameに関するテスト
     * 255文字を超えて登録しようとすると
     * ステータスコード400を返却すること
     */
    public function testInvalidOverMaxName()
    {
      $itemdata = [
        'name' => 'hogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehoge',
        'email' => 'hogehoge@example.com',
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * emailに関するテスト
     * 空文字でリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateBrankEmail()
    {
      $itemdata = [
        'name' => 'hogehgoe',
        'email' => '',
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * emailに関するテスト
     * Nullでリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateNullEmail()
    {
      $itemdata = [
        'name' => 'hogehgoe',
        'email' => null,
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * emailに関するテスト
     * emailパラメータをリクエストしなかったら
     * ステータスコード400を返却すること
     */
    public function testValidateNotExistEmailParam()
    {
      $itemdata = [
        'name' => 'hogehgoe',
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * emailに関するテスト
     * emailの形式でリクエストしなかったら
     * ステータスコード400を返却すること
     */
    public function testValidateNotEmailFormat()
    {
      $itemdata = [
        'name' => 'hogehoge',
        'email' => 'hogehoge@',
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * emailに関するテスト
     * 255文字を超えて登録しようとすると
     * ステータスコード400を返却すること
     */
    public function testInvalidOverMaxEmail()
    {
      $itemdata = [
        'name' => 'hogehoge',
        'email' => 'hogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehogehoge',
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * emailに関するテスト
     * usersテーブルに登録済みのemailアドレスで登録しようとすると
     * ステータスコード400を返却すること
     */
    public function testInvalidAlreadyRegisteredEmail()
    {
      $itemdata = [
        'name' => 'hogehoge',
        'email' => 'aaaa@example.com',
        'password' => Hash::make('hogehoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * passwordに関するテスト
     * 空文字でリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateBrankPassword()
    {
      $itemdata = [
        'name' => 'hogehoge',
        'email' => 'hogehoge@example.com',
        'password' => '',
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * passwordに関するテスト
     * Nullでリクエストしたら
     * ステータスコード400を返却すること
     */
    public function testValidateNullPassword()
    {
      $itemdata = [
        'name' => 'hogehoge',
        'email' => 'hogehoge@example.com',
        'password' => null,
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * passwordに関するテスト
     * passwordパラメータをリクエストしなかったら
     * ステータスコード400を返却すること
     */
    public function testValidateNotExistPasswordParam()
    {
      $itemdata = [
        'name' => 'hogehoge',
        'email' => 'hogehoge@example.com',
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * passwordに関するテスト
     * 文字列ではなかったら
     * ステータスコード400を返却すること
     */
    public function testInvalidNotStringPassword()
    {
      $itemdata = [
        'name' => 'hogehoge',
        'email' => 'hogehoge@example.com',
        'password' => true,
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

    /**
     * passwordに関するテスト
     * 8文字未満で登録しようとすると
     * ステータスコード400を返却すること
     */
    public function testInvalidNotEnoughPassword()
    {
      $itemdata = [
        'name' => 'hogehoge',
        'email' => 'hogehoge@example.com',
        'password' => Hash::make('hoge'),
      ];
      $response = $this->post('/api/register', $itemdata);
      $response->assertStatus(400);
    }

}
