<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeNewTrait;
use Tests\ApiTestTrait;

class NewApiTest extends TestCase
{
    use MakeNewTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_new()
    {
        $new = $this->fakeNewData();
        $this->response = $this->json('POST', '/api/news', $new);

        $this->assertApiResponse($new);
    }

    /**
     * @test
     */
    public function test_read_new()
    {
        $new = $this->makeNew();
        $this->response = $this->json('GET', '/api/news/'.$new->id);

        $this->assertApiResponse($new->toArray());
    }

    /**
     * @test
     */
    public function test_update_new()
    {
        $new = $this->makeNew();
        $editedNew = $this->fakeNewData();

        $this->response = $this->json('PUT', '/api/news/'.$new->id, $editedNew);

        $this->assertApiResponse($editedNew);
    }

    /**
     * @test
     */
    public function test_delete_new()
    {
        $new = $this->makeNew();
        $this->response = $this->json('DELETE', '/api/news/'.$new->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/news/'.$new->id);

        $this->response->assertStatus(404);
    }
}
