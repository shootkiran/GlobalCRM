<?php

namespace Filament\Forms\Components\Concerns;

use Closure;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Text;
use Illuminate\Contracts\Support\Htmlable;

trait HasHelperText
{
    public function helperText(string | Htmlable | Closure | null $text): static
    {
        $this->belowContent(fn (Component $component): Text => Text::make($component->evaluate($text)));

        return $this;
    }
}
