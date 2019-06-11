<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClassTypeTrait;
use Tests\ApiTestTrait;

class ClassTypeApiTest extends TestCase
{
    use MakeClassTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_class_type()
    {
        $classType = $this->fakeClassTypeData();
        $this->response = $this->json('POST', '/api/classTypes', $classType);

        $this->assertApiResponse($classType);
    }

    /**
     * @test
     */
    public function test_read_class_type()
    {
        $classType = $this->makeClassType();
        $this->response = $this->json('GET', '/api/classTypes/'.$classType->id);

        $this->assertApiResponse($classType->toArray());
    }

    /**
     * @test
     */
    public function test_update_class_type()
    {
        $classType = $this->makeClassType();
        $editedClassType = $this->fakeClassTypeData();

        $this->response = $this->json('PUT', '/api/classTypes/'.$classType->id, $editedClassType);

        $this->assertApiResponse($editedClassType);
    }

    /**
     * @test
     */
    public function test_delete_class_type()
    {
        $classType = $this->makeClassType();
        $this->response = $this->json('DELETE', '/api/classTypes/'.$classType->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/classTypes/'.$classType->id);

        $this->response->assertStatus(404);
    }
}
