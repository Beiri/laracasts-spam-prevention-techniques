<?php

namespace App\Honeypot;

use Illuminate\Http\Request;

class Honeypot
{
    protected $request;
    protected static $response;
    protected $config;

    public function __construct(Request $request, array $config)
    {
        $this->request = $request;
        $this->config = $config;
    }

    public function enabled()
    {
        return $this->config['enabled'];
    }

    public function detect()
    {
        if (! $this->enabled()) {
            return false;
        }

        if (! $this->request->has($this->config['field_name'])) {
            return true;
        }

        if (! empty($this->request->input($this->config['field_name']))) {
            return true;
        }

        if ($this->submittedTooQuickly() <= $this->config['minimum_time']) {
            return true;
        }

        return false;
    }

    public static function abortUsing(callable $response)
    {
        static::$response = $response;
    }

    public function abort()
    {
        if (static::$response) {
            return call_user_func(static::$response);
        }

        return abort(422, 'Spam detected');
    }

    protected function submittedTooQuickly()
    {
        return microtime(true) - $this->request->input($this->config['field_time_name']);
    }
}
