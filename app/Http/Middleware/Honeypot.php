<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Honeypot
{
    public function handle(Request $request, Closure $next)
    {
        $config = config('honeypot');

        if (! $config['enabled']) {
            return $next($request);
        }

        if (! $request->has($config['field_name'])) {
            return $this->abort();
        }

        if (! empty($request->input($config['field_name']))) {
            return $this->abort();
        }

        if ($this->timeToSubmitForm($request, $config) <= $config['minimum_time']) {
            return $this->abort();
        }

        return $next($request);
    }

    protected function timeToSubmitForm(Request $request, array $config)
    {
        return microtime(true) - $request->input($config['field_time_name']);
    }

    protected function abort()
    {
        return abort(422, 'Spam detected');
    }
}
