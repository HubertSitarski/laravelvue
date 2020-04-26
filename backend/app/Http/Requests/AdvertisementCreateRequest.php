<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateAdvertisement
 * @package App\Http\Requests
 */
class AdvertisementCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required',
            'user_id' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required|numeric'
        ];
    }
}
