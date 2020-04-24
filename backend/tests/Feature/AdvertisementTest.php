<?php

namespace Tests\Feature;

use App\Advertisement;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

/**
 * Class AdvertisementTest
 * @package Tests\Feature
 */
class AdvertisementTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthorizedUser()
    {
        $this->authorize();

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('GET', '/api/advertisements');

        $response
            ->assertStatus(200);
    }

    public function testUnauthorizedUser()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('GET', '/api/advertisements');

        $response
            ->assertStatus(401);
    }

    public function testGetDetails()
    {
        $this->authorize();
        $advertisement = factory(Advertisement::class)->create();

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('GET', '/api/advertisements/' . $advertisement->id);

        $response
            ->assertStatus(200)
            ->assertJson([
                'title' => $advertisement->title,
                'description' => $advertisement->description,
                'quantity' => $advertisement->quantity,
                'price' => $advertisement->price,
                'user_id' => $advertisement->user_id
            ]);
    }

    public function testCreateSuccess()
    {
        $user = $this->authorize();

        $data = [
            'title' => 'Test',
            'description' => 'Test Description',
            'quantity' => 2,
            'price' => 400.99,
            'user_id' => $user->id
        ];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('POST', '/api/advertisements', $data);

        $response
            ->assertStatus(201)
            ->assertJson($data);
    }

    public function testCreateFailure()
    {
        $this->authorize();

        $data = [
        ];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('POST', '/api/advertisements', $data);

        $response
            ->assertStatus(422)
        ;
    }

    public function testUpdateSuccess()
    {
        $user = $this->authorize();

        $advertisement = factory(Advertisement::class)->create();

        $data = [
            'title' => 'Test',
            'description' => 'Test Description',
            'quantity' => 2,
            'price' => 400.99,
            'user_id' => $user->id
        ];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('PUT', '/api/advertisements/' . $advertisement->id, $data);

        $response
            ->assertStatus(200)
            ->assertJson($data);
    }

    public function testUpdateFailure()
    {
        $this->authorize();

        $advertisement = factory(Advertisement::class)->create();

        $data = [
        ];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('PUT', '/api/advertisements/' . $advertisement->id, $data);

        $response
            ->assertStatus(422);
    }

    public function testUpdateNotFound()
    {
        $this->authorize();

        $data = [
        ];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('PUT', '/api/advertisements/' . 123456, $data);

        $response
            ->assertStatus(404);
    }

    public function testDeleteSuccess()
    {
        $this->authorize();

        $advertisement = factory(Advertisement::class)->create();

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('DELETE', '/api/advertisements/' . $advertisement->id);

        $response
            ->assertStatus(204);
    }

    public function testDeleteNotFound()
    {
        $this->authorize();

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->json('DELETE', '/api/advertisements/' . 420402);

        $response
            ->assertStatus(404);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private function authorize()
    {
        $user = factory(User::class)->create();

        Passport::actingAs($user);

        return $user;
    }
}
