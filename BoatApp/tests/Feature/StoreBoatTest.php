<?php

namespace Tests\Feature;


use App\Models\Boat;
use Tests\BaseTestCase;

class StoreBoatTest extends BaseTestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $boat = factory(Boat::class)->make();

        $boatCount = Boat::all()->count();

        $response = $this->actingAs($this->authenticatedUser(), 'api')
        ->postApiWithAuth(route('api-boat-store'), $boat->toArray());

        $response->dump();

        $response->assertOk();
        $response->assertJson(['boat' => [
            'name' => $boat->name,
            'description' => $boat->description,
        ]]);
        $this->assertTrue(Boat::all()->count() === $boatCount + 1);
    }
}
