<?php

declare(strict_types=1);

namespace App\View\Components\Forms;

use BladeUIKit\Components\BladeComponent;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class Label extends BladeComponent
{
    public $for;

    public function __construct(string $for)
    {
        $this->for = $for;
    }

    public function render(): View
    {
        return view('blade-ui-kit::components.forms.label');
    }

    public function fallback(): string
    {
        return ucwords(Str::lower(str_replace('_', ' ', $this->for)));
    }
}
