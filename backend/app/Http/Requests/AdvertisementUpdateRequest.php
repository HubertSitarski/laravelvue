<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateAdvertisement
 * @package App\Http\Requests
 */
class AdvertisementUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string',
            'user_id' => 'integer',
            'quantity' => 'integer',
            'price' => 'numeric'
        ];
    }
}
