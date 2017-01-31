<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBlogResponseIsValid()
    {
        $response = $this->get('/json');
        $response->assertStatus(200);
    }
}
