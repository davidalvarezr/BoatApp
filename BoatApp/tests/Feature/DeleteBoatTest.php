<?php

namespace Tests\Feature;

use App\Models\Boat;
use Tests\BaseTestCase;

class DeleteBoatTest extends BaseTestCase
{
    private $route = 'api-boat-delete';

    public function testDelete()
    {
        $boat = factory(Boat::class)->create();
        $boatCount = Boat::all()->count();
        $response = $this->actingAs($this->authenticatedUser(), 'api')
            ->deleteApi(route($this->route, $boat->getKey()));
        $response->assertOk();
        $this->assertTrue(Boat::all()->count() === $boatCount - 1);
        $response->assertJson([
            'boat' => [
                'name' => $boat->name,
                'description' => $boat->description,
            ]
        ]);
    }

    public function testDeleteNoAuth()
    {
        $boat = factory(Boat::class)->create();
        $response = $this->deleteApi(route($this->route, $boat->getKey()));
        $response->assertStatus(401);
    }

    public function testDeleteNonExistent()
    {
        $nonExistentId = $this->nonExistentId(Boat::class);
        $response = $this->actingAs($this->authenticatedUser(), 'api')
            ->deleteApi(route($this->route, $nonExistentId));
        $response->assertStatus(404);
    }
}
