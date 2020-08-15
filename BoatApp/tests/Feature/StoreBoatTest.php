<?php

namespace Tests\Feature;


use App\Models\Boat;
use Tests\BaseTestCase;

class StoreBoatTest extends BaseTestCase
{

    public function testStore()
    {
        $boat = factory(Boat::class)->make();
        $boatCount = Boat::all()->count();
        $response = $this
            ->actingAs($this->authenticatedUser(), 'api')
            ->postApi(route('api-boat-store'), $boat->toArray());
        $response->dump();
        $response->assertOk();
        $response->assertJson(['boat' => [
            'name' => $boat->name,
            'description' => $boat->description,
        ]]);
        $this->assertTrue(Boat::all()->count() === $boatCount + 1);
        $response->assertJson([
           'boat' => [
               'name' => $boat->name,
               'description' => $boat->description,
           ]
        ]);
    }

    public function testStoreNoAuth()
    {
        $boat = factory(Boat::class)->make();
        $response = $this->postApi(route('api-boat-store'), $boat->toArray());
        $response->dump();
        $response->assertStatus(401); // Unauthorized
    }

    public function testStoreInvalid()
    {
        $boat = factory(Boat::class)->state('invalid')->make();
        $response = $this
            ->actingAs($this->authenticatedUser(), 'api')
            ->postApi(route('api-boat-store'), $boat->toArray());
        $response->dump();
        $response->assertStatus(422);

    }

}
