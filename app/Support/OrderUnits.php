<?php

namespace App\Support;

class OrderUnits
{
    public const LINE_KEY_SEP = '__';

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

    public static function unitOptions(): array
    {
        return collect(self::UNITS)
            ->map(fn (string $unit) => ['value' => $unit, 'label' => self::label($unit)])
            ->values()
            ->all();
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
        return $productId . self::LINE_KEY_SEP . self::normalize($unit);
    }

    public static function lineKeyPattern(): string
    {
        return '[0-9]+__(' . implode('|', self::UNITS) . ')';
    }

    public static function isValidLineKey(string $key): bool
    {
        return (bool) preg_match('/^' . self::lineKeyPattern() . '$/', $key);
    }

    public static function resolveLineKey(string $key, array $item = []): string
    {
        if (self::isValidLineKey($key)) {
            return $key;
        }

        if (preg_match('/^(\d+):(' . implode('|', self::UNITS) . ')$/', $key, $matches)) {
            return self::cartLineKey((int) $matches[1], $matches[2]);
        }

        if (preg_match('/^\d+$/', $key)) {
            return self::cartLineKey((int) $key, $item['unit'] ?? 'pcs');
        }

        if (!empty($item['product_id'])) {
            return self::cartLineKey((int) $item['product_id'], $item['unit'] ?? 'pcs');
        }

        return $key;
    }
}
