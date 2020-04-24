<?php

namespace Tests\Feature;

use App\Advertisement;
use App\Http\Constants\HttpMethods;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * Class AdvertisementTest
 * @package Tests\Feature
 */
class AdvertisementTest extends TestCase
{
    use RefreshDatabase;

    private static $HEADERS = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];

    private $uriBase = '/api/advertisements/';

    public function testAuthorizedUser()
    {
        $this->authorize();

        $response = $this->buildResponse(HttpMethods::GET, $this->uriBase);

        $response
            ->assertStatus(200);
    }

    public function testUnauthorizedUser()
    {
        $response = $this->buildResponse(HttpMethods::GET, $this->uriBase);

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testGetDetails()
    {
        $this->authorize();
        $advertisement = factory(Advertisement::class)->create();

        $response = $this->buildResponse(HttpMethods::GET, $this->uriBase . $advertisement->id);

        $response
            ->assertStatus(Response::HTTP_OK)
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

        $data = $this->prepareAdvertisementData($user);

        $response = $this->buildResponse(HttpMethods::POST, $this->uriBase, $data);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson($data);
    }

    public function testCreateFailure()
    {
        $this->authorize();

        $response = $this->buildResponse(HttpMethods::POST, $this->uriBase);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ;
    }

    public function testUpdateSuccess()
    {
        $user = $this->authorize();

        $advertisement = factory(Advertisement::class)->create();

        $data = $this->prepareAdvertisementData($user);

        $response = $this->buildResponse(HttpMethods::PUT, $this->uriBase . $advertisement->id, $data);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($data);
    }

    public function testUpdateFailure()
    {
        $this->authorize();

        $advertisement = factory(Advertisement::class)->create();

        $response = $this->buildResponse(HttpMethods::PUT, $this->uriBase . $advertisement->id);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testUpdateNotFound()
    {
        $this->authorize();

        $response = $this->buildResponse(HttpMethods::PUT, $this->uriBase . 123456);

        $response
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testDeleteSuccess()
    {
        $this->authorize();

        $advertisement = factory(Advertisement::class)->create();

        $response = $this->buildResponse(HttpMethods::DELETE, $this->uriBase . $advertisement->id);

        $response
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function testDeleteNotFound()
    {
        $this->authorize();

        $response = $this->buildResponse(HttpMethods::DELETE, $this->uriBase . 420402);

        $response
            ->assertStatus(Response::HTTP_NOT_FOUND);
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

    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @return TestResponse
     */
    private function buildResponse(string $method, string $uri, array $data = []): TestResponse
    {
        return $this->withHeaders(self::$HEADERS)->json($method, $uri, $data);
    }

    /**
     * @param User $user
     * @return array
     */
    private function prepareAdvertisementData(User $user): array
    {
        return [
            'title' => 'Test',
            'description' => 'Test Description',
            'quantity' => 2,
            'price' => 400.99,
            'user_id' => $user->id
        ];
    }
}
