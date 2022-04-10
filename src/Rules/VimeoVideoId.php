<?php

namespace Vimeo\Laravel\Rules;

use Illuminate\Contracts\Validation\Rule;
use Vimeo\Laravel\Facades\Vimeo;

class VimeoVideoId implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $response = Vimeo::request('/videos/'.$value, [], 'GET');

        return data_get($response, 'status') === 200;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The :attribute format is invalid.');
    }
}
