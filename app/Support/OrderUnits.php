<?php

namespace App\Support;

class OrderUnits
{
    public const UNITS = ['pcs', 'dus', 'gantung', 'strip', 'pak'];

    public const LABELS = [
        'pcs'     => 'Pcs',
        'dus'     => 'Dus',
        'gantung' => 'Gantung',
        'strip'   => 'Strip',
        'pak'     => 'Pak',
    ];

    public static function all(): array
    {
        return self::UNITS;
    }

    public static function isValid(string $unit): bool
    {
        return in_array($unit, self::UNITS, true);
    }

    public static function label(string $unit): string
    {
        return self::LABELS[$unit] ?? ucfirst($unit);
    }

    public static function normalize(?string $unit): string
    {
        $unit = strtolower(trim((string) $unit));

        return self::isValid($unit) ? $unit : 'pcs';
    }

    public static function cartLineKey(int $productId, string $unit): string
    {
        return $productId . ':' . self::normalize($unit);
    }
}
