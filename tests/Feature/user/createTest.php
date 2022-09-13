<?php

namespace Tests\Feature\user;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Collection;

class createTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $user_proto = User::factory()->make();
        $this->user = [
            'email' => $user_proto->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'last_name' => $user_proto->last_name,
            'first_name' => $user_proto->first_name,
            'last_name_kana' => $user_proto->last_name_kana,
            'first_name_kana' => $user_proto->first_name_kana,
            'phone' => $user_proto->phone,
            'zip' => $user_proto->zip,
            'address' => $user_proto->address,
        ];
    }

    /** @test */
    public function ユーザー登録画面が表示される()
    {
        $response = $this->get('/register')
            ->assertStatus(200);
    }

    /** @test */
    public function ユーザーが登録できる()
    {
        $user = User::factory()->make();
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasNoErrors();
    }
    
    /** @test */
    public function 不正なメールアドレスは不可()
    {
        $this->user['email'] = 'failed@@example.com';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function パスワードが8文字以下は不可()
    {
        $this->user['password'] = '123';
        $this->user['password_confirmation'] = '123';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function 確認パスワードが一致しない場合不可()
    {
        $this->user['password'] = 'password';
        $this->user['password_confirmation'] = '123';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function 姓が未入力は不可()
    {
        $this->user['last_name'] = '';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function 姓が21字以上は不可()
    {
        $this->user['last_name'] = fake()->words(21);
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('last_name');
    }    

    /** @test */
    public function 名が未入力は不可()
    {
        $this->user['first_name'] = '';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function 名が21字以上は不可()
    {
        $this->user['first_name'] = fake()->words(21);
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('first_name');
    }   

    /** @test */
    public function 姓フリガナが未入力は不可()
    {
        $this->user['last_name_kana'] = '';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('last_name_kana');
    }

    /** @test */
    public function 姓フリガナが21字以上は不可()
    {
        $this->user['last_name_kana'] = str_repeat('ア', 21);
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('last_name_kana');
    }

    /** @test */
    public function 姓フリガナが全角カタカナ以外は不可()
    {
        $this->user['last_name_kana'] = 'ｱｲｳｴｵ';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('last_name_kana');
    }

    /** @test */
    public function 名フリガナが未入力は不可()
    {
        $this->user['first_name_kana'] = '';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('first_name_kana');
    }

    /** @test */
    public function 名フリガナが21字以上は不可()
    {
        $this->user['first_name_kana'] = str_repeat('ア', 21);
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('first_name_kana');
    }

    /** @test */
    public function 名フリガナが全角カタカナ以外は不可()
    {
        $this->user['first_name_kana'] = 'ｱｲｳｴｵ';
        $response = $this->post('/register', $this->user);;
        $response->assertSessionHasErrors('first_name_kana');
    }

    /** @test */
    public function 電話番号が空白は不可()
    {
        $this->user['phone'] = '';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function 電話番号が10桁未満は不可()
    {
        $this->user['phone'] = '123456789';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function 電話番号が12桁未満は不可()
    {
        $this->user['phone'] = '123456789012';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('phone');
    }
    
    /** @test */
    public function 電話番号がハイフン入りは不可()
    {
        $this->user['phone'] = '03-1234-5678';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function 電話番号が全角は不可()
    {
        $this->user['phone'] = '０３－１２３４－５６７８';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('phone');
    }

    /** @test */
    public function 郵便番号が空白は不可()
    {
        $this->user['zip'] = '';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('zip');
    }

    /** @test */
    public function 郵便番号が7桁未満は不可()
    {
        $this->user['zip'] = '123456';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('zip');
    }

    /** @test */
    public function 郵便番号が8桁以上は不可()
    {
        $this->user['zip'] = '12345678';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('zip');
    }

    /** @test */
    public function 郵便番号が全角は不可()
    {
        $this->user['zip'] = '１２３４５６７';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('zip');
    }

    /** @test */
    public function 住所が空白は不可()
    {
        $this->user['address'] = '';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('address');
    }

    /** @test */
    public function 住所が81字以上は不可()
    {
        $this->user['address'] = fake()->words(81);
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('address');
    }

    /** @test */
    public function メールアドレスが空白は不可()
    {
        $this->user['email'] = '';
        $response = $this->post('/register', $this->user);
        $response->assertSessionHasErrors('email');
    }
}
