<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClassTrait;
use Tests\ApiTestTrait;

class ClassApiTest extends TestCase
{
    use MakeClassTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_class()
    {
        $class = $this->fakeClassData();
        $this->response = $this->json('POST', '/api/classes', $class);

        $this->assertApiResponse($class);
    }

    /**
     * @test
     */
    public function test_read_class()
    {
        $class = $this->makeClass();
        $this->response = $this->json('GET', '/api/classes/'.$class->id);

        $this->assertApiResponse($class->toArray());
    }

    /**
     * @test
     */
    public function test_update_class()
    {
        $class = $this->makeClass();
        $editedClass = $this->fakeClassData();

        $this->response = $this->json('PUT', '/api/classes/'.$class->id, $editedClass);

        $this->assertApiResponse($editedClass);
    }

    /**
     * @test
     */
    public function test_delete_class()
    {
        $class = $this->makeClass();
        $this->response = $this->json('DELETE', '/api/classes/'.$class->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/classes/'.$class->id);

        $this->response->assertStatus(404);
    }
}
