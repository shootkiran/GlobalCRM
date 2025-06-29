<?php

namespace App;

use Filament\Support\Contracts\HasLabel;

enum AccountType: string implements HasLabel
{
    case Cash = 'cash';
    case Bank = 'bank';
    case Wallet = 'wallet';
    case Other = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::Cash => 'Cash',
            self::Bank => 'Bank Account',
            self::Wallet => 'Online Wallet',
            self::Other => 'Other',
        };
    }
}
