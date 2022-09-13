<?php

namespace Tests\Feature\user;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class editTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->user_proto = User::factory()->create();
        $this->user = [
            'email' => $this->user_proto->email,
            'last_name' => $this->user_proto->last_name,
            'first_name' => $this->user_proto->first_name,
            'last_name_kana' => $this->user_proto->last_name_kana,
            'first_name_kana' => $this->user_proto->first_name_kana,
            'phone' => $this->user_proto->phone,
            'zip' => $this->user_proto->zip,
            'address' => $this->user_proto->address,
        ];
    }

    /** @test */
    public function ユーザー編集画面が表示される()
    {
        $response = $this->actingAs($this->user_proto)
            ->get(route('user.user.edit', ['user' => $this->user_proto->id]));
        $this->get('/')->assertStatus(200);
    }

    /** @test */
    public function 未ログインの場合ログイン画面にリダイレクトされる()
    {
        $response = $this->get(route('user.user.edit', ['user' => $this->user_proto->id]))
            ->assertLocation('login');
    }

    /** @test */
    public function ユーザー情報の更新ができる()
    {
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('users', [
            'email' => $this->user['email'],
            'last_name' => $this->user['last_name'],
            'first_name' => $this->user['first_name'],
            'last_name_kana' => $this->user['last_name_kana'],
            'first_name_kana' => $this->user['first_name_kana'],
            'phone' => $this->user['phone'],
            'zip' => $this->user['zip'],
            'address' => $this->user['address'],
        ]);
    }

    /** @test */
    public function 不正なメールアドレスは不可()
    {
        $this->user['email'] = 'failed@@example.com';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function 姓が未入力は不可()
    {
        $this->user['last_name'] = '';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function 姓が21字以上は不可()
    {
        $this->user['last_name'] = fake()->words(21);
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('last_name');
    }    

    /** @test */
    public function 名が未入力は不可()
    {
        $this->user['first_name'] = '';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function 名が21字以上は不可()
    {
        $this->user['first_name'] = fake()->words(21);
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('first_name');
    }   

    /** @test */
    public function 姓フリガナが未入力は不可()
    {
        $this->user['last_name_kana'] = '';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('last_name_kana');
    }

    /** @test */
    public function 姓フリガナが21字以上は不可()
    {
        $this->user['last_name_kana'] = str_repeat('ア', 21);
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('last_name_kana');
    }

    /** @test */
    public function 姓フリガナが全角カタカナ以外は不可()
    {
        $this->user['last_name_kana'] = 'ｱｲｳｴｵ';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('last_name_kana');
    }

    /** @test */
    public function 名フリガナが未入力は不可()
    {
        $this->user['first_name_kana'] = '';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('first_name_kana');
    }

    /** @test */
    public function 名フリガナが21字以上は不可()
    {
        $this->user['first_name_kana'] = str_repeat('ア', 21);
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('first_name_kana');
    }

    /** @test */
    public function 名フリガナが全角カタカナ以外は不可()
    {
        $this->user['first_name_kana'] = 'ｱｲｳｴｵ';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);;
        $response->assertSessionHasErrors('first_name_kana');
    }

    /** @test */
    public function 電話番号が空白は不可()
    {
        $this->user['phone'] = '';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function 電話番号が10桁未満は不可()
    {
        $this->user['phone'] = '123456789';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function 電話番号が12桁未満は不可()
    {
        $this->user['phone'] = '123456789012';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('phone');
    }
    
    /** @test */
    public function 電話番号がハイフン入りは不可()
    {
        $this->user['phone'] = '03-1234-5678';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function 電話番号が全角は不可()
    {
        $this->user['phone'] = '０３－１２３４－５６７８';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function 郵便番号が空白は不可()
    {
        $this->user['zip'] = '';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('zip');
    }

    /** @test */
    public function 郵便番号が7桁未満は不可()
    {
        $this->user['zip'] = '123456';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('zip');
    }

    /** @test */
    public function 郵便番号が8桁以上は不可()
    {
        $this->user['zip'] = '12345678';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('zip');
    }

    /** @test */
    public function 郵便番号が全角は不可()
    {
        $this->user['zip'] = '１２３４５６７';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('zip');
    }

    /** @test */
    public function 住所が空白は不可()
    {
        $this->user['address'] = '';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('address');
    }

    /** @test */
    public function 住所が81字以上は不可()
    {
        $this->user['address'] = fake()->words(81);
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('address');
    }

    /** @test */
    public function メールアドレスが空白は不可()
    {
        $this->user['email'] = '';
        $response = $this->actingAs($this->user_proto)
            ->put(route('user.user.update', ['user' => $this->user_proto->id]), $this->user);
        $response->assertSessionHasErrors('email');
    }
}
