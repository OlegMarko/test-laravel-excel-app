<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxSizeUploadFile implements Rule
{
    /** @var float|int  */
    private $postMaxSize;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->postMaxSize = $this->getPostMaxSize();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value->getSize() > $this->postMaxSize) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute must be {$this->postMaxSize} kilobytes";
    }

    /**
     * Determine the server 'post_max_size' as bytes.
     *
     * @return int
     */
    protected function getPostMaxSize()
    {
        if (is_numeric($postMaxSize = ini_get('post_max_size'))) {
            return (int)$postMaxSize;
        }

        $metric = strtoupper(substr($postMaxSize, -1));

        switch ($metric) {
            case 'K':
                return (int)$postMaxSize * 1024;
            case 'M':
                return (int)$postMaxSize * 1048576;
            default:
                return (int)$postMaxSize;
        }
    }
}
