<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Subject: string implements HasLabel
{
    case Math = 'math';
    case Science = 'science';
    case History = 'history';
    case English = 'english';

    public static function toSelectArray(): array
    {
        return [
            self::English,
            self::History,
            self::Math,
            self::Science,
        ];
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
