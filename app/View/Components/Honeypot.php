<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Honeypot extends Component
{
    var $fieldName, $fieldTimeName;

    public function __construct()
    {
        $this->fieldName = config('honeypot.field_name');
        $this->fieldTimeName = config('honeypot.field_time_name');
    }

    public function render()
    {
        return <<<'blade'
            <div style="display: none;">
                <div>
                    <input type="text" name="{{ $fieldName }}" id="{{ $fieldName }}">
                </div>

                <div>
                    <input type="text" name="{{ $fieldTimeName }}" id="{{ $fieldTimeName }}" value={{ microtime(true) }}>
                </div>
            </div>
        blade;
    }
}
