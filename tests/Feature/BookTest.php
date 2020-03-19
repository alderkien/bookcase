<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Author;
use App\Book;


class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testBooks()
    {
        $response = $this->get('/books');
        $response->assertStatus(200);
    }

    public function testCreateAccess()
    {
        $response = $this->get('/books/create');
        $response->assertStatus(302);
    }

    public function testStoreAccess()
    {
        $response = $this->get('/books/store');
        $response->assertStatus(405);

        $response = $this->post('/books/store');
        $response->assertStatus(302);
    }

    public function testStoreSuccess(){
        $user = factory(User::class)->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->post('/books/store', [
            'name' => 'ItNeedToBeDestroyed__now',
            'description' => 'Тестовое описание',
            'isbn' => '1234567890123',
            'authors' => Author::all()->random(3)->pluck('id')->toArray(),
        ]);

        $response->assertRedirect('/books');

        $this->assertDatabaseHas('books', [
            'name' => 'ItNeedToBeDestroyed__now',
        ]);

        Book::where('name', 'ItNeedToBeDestroyed__now')->delete();
        $user->delete();
    }

    public function testStoreFail(){
        $user = factory(User::class)->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response = $this->post('/books/store');
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name','description','isbn','authors']);

        $response = $this->post('/books/store',['isbn'=>'1234567890123456789012345678901']);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['isbn']);

        $user->delete();
    }

}
