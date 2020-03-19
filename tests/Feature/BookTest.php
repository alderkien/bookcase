<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


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

}
