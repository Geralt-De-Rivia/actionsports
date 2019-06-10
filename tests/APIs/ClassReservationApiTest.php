<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClassReservationTrait;
use Tests\ApiTestTrait;

class ClassReservationApiTest extends TestCase
{
    use MakeClassReservationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_class_reservation()
    {
        $classReservation = $this->fakeClassReservationData();
        $this->response = $this->json('POST', '/api/classReservations', $classReservation);

        $this->assertApiResponse($classReservation);
    }

    /**
     * @test
     */
    public function test_read_class_reservation()
    {
        $classReservation = $this->makeClassReservation();
        $this->response = $this->json('GET', '/api/classReservations/'.$classReservation->id);

        $this->assertApiResponse($classReservation->toArray());
    }

    /**
     * @test
     */
    public function test_update_class_reservation()
    {
        $classReservation = $this->makeClassReservation();
        $editedClassReservation = $this->fakeClassReservationData();

        $this->response = $this->json('PUT', '/api/classReservations/'.$classReservation->id, $editedClassReservation);

        $this->assertApiResponse($editedClassReservation);
    }

    /**
     * @test
     */
    public function test_delete_class_reservation()
    {
        $classReservation = $this->makeClassReservation();
        $this->response = $this->json('DELETE', '/api/classReservations/'.$classReservation->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/classReservations/'.$classReservation->id);

        $this->response->assertStatus(404);
    }
}
