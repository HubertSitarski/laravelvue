<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Http\Requests\AdvertisementRequest;
use App\Repository\Eloquent\AdvertisementRepository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdvertisementController
 * @package App\Http\Controllers
 */
class AdvertisementController extends Controller
{
    private $advertisementRepository;

    /**
     * AdvertisementController constructor.
     * @param AdvertisementRepository $advertisementRepository
     */
    public function __construct(AdvertisementRepository $advertisementRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return $this->advertisementRepository->findAll();
    }

    /**
     * @param Advertisement $advertisement
     * @return Advertisement|Model
     */
    public function show(Advertisement $advertisement)
    {
        return $this->advertisementRepository->find($advertisement->id);
    }

    /**
     * @param AdvertisementRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(AdvertisementRequest $request)
    {
        $article = $this->advertisementRepository->create($request->all());

        return response()->json($article, Response::HTTP_CREATED);
    }

    /**
     * @param AdvertisementRequest $request
     * @param Advertisement $advertisement
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        $this->advertisementRepository->update($request->all(), $advertisement->id);

        return response()->json($this->advertisementRepository->find($advertisement->id), Response::HTTP_OK);
    }

    /**
     * @param Advertisement $advertisement
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Advertisement $advertisement)
    {
        $this->advertisementRepository->delete($advertisement->id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Advertisement $advertisement
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(Advertisement $advertisement)
    {
        $this->advertisementRepository->restore($advertisement->id);

        return response()->json($this->advertisementRepository->find($advertisement->id), Response::HTTP_OK);
    }
}
