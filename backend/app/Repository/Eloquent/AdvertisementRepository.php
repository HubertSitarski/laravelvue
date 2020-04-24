<?php

namespace App\Repository\Eloquent;

use App\Advertisement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class AdvertisementRepository
 * @package App\Repository\Eloquent
 */
class AdvertisementRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     *
     * @param Advertisement $advertisement
     */
    public function __construct(Advertisement $advertisement)
    {
        parent::__construct($advertisement);
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model->with('user')->where(['deleted' => false])->get();
    }

    /**
     * @param int $id
     * @return Advertisement|Model
     */
    public function find(int $id): ?Model
    {
        return $this->model->where(['deleted' => false])->find($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->changeDeletedValue($id, true);
    }

    /**
     * @param $id
     * @return bool
     */
    public function restore($id)
    {
        return $this->changeDeletedValue($id, false);
    }

    /**
     * @param int $id
     * @param bool $value
     * @return bool
     */
    private function changeDeletedValue(int $id, bool $value): bool
    {
        $advertisement = $this->find($id);
        $advertisement->deleted = $value;

        return $advertisement->save();
    }
}
