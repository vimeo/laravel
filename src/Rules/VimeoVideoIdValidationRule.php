<?php
namespace Vimeo\Laravel\Rules;

use Illuminate\Contracts\Validation\Rule;
use Vimeo\Laravel\Facades\Vimeo;

class VimeoVideoIdValidationRule implements Rule
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
        // Make an API request to Vimeo to check if the video with the given ID exists.
        // Replace 'your-api-endpoint' with the actual API endpoint you want to use.
        $response = Vimeo::request('/videos/'.$value, [], 'GET');

        // Check if the response status is 200, indicating a successful request.
        return data_get($response, 'status') === 200;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // Return a generic error message if the validation fails.
        return __('The :attribute format is invalid.');
    }
}
