<?php

namespace Tests\Feature;

use App\Models\Boat;
use Tests\BaseTestCase;

class UpdateBoatTest extends BaseTestCase
{

    public function testUpdate()
    {
        $boat = factory(Boat::class)->create();
        $boatCount = Boat::all()->count();
        $boatUpdate = factory(Boat::class)->make();

        $response = $this
            ->actingAs($this->authenticatedUser(), 'api')
            ->putApi(route('api-boat-update', ['id' => $boat->getKey()]), $boatUpdate->toArray());
        $response->dump();

        $response->assertOk();
        $this->assertTrue(Boat::all()->count() === $boatCount, Boat::all()->count() . "\n" . $boatCount);
        $response->assertJson([
            'boat' => [
                'name' => $boatUpdate->name,
                'description' => $boatUpdate->description,
            ]
        ]);
    }

    public function testUpdateNoAuth()
    {
        $boat = factory(Boat::class)->create();
        $boatUpdate = factory(Boat::class)->make();

        $response = $this->putApi(route('api-boat-update', $boat->getKey()), $boatUpdate->toArray());
        $response->dump();

        $response->assertStatus(401); // Unauthorized
    }

    public function testUpdateInvalid()
    {
        $boat = factory(Boat::class)->create();
        $boatUpdate = factory(Boat::class)->state('invalid')->make();

        $response = $this
            ->actingAs($this->authenticatedUser(), 'api')
            ->putApi(route('api-boat-update', $boat->getKey()), $boatUpdate->toArray());
        $response->dump();

        $response->assertStatus(422);
    }

}
