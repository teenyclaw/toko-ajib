<?php

namespace App\Support;

class OrderSessionCart
{
    public const SESSION_KEY = 'order_cart';

    public static function get(): array
    {
        $cart     = session()->get(self::SESSION_KEY, []);
        $migrated = self::migrateCartKeys($cart);

        if ($migrated !== $cart) {
            session()->put(self::SESSION_KEY, CartOrder::ensure($migrated));
        }

        return $migrated;
    }

    public static function put(array $cart): void
    {
        session()->put(self::SESSION_KEY, CartOrder::ensure($cart));
    }

    public static function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public static function count(): int
    {
        return count(self::get());
    }

    public static function totalQty(): int
    {
        return (int) collect(self::get())->sum('qty');
    }

    private static function migrateCartKeys(array $cart): array
    {
        if ($cart === []) {
            return [];
        }

        $migrated = [];

        foreach ($cart as $key => $item) {
            if (!is_array($item)) {
                continue;
            }

            $newKey = OrderUnits::resolveLineKey((string) $key, $item);

            if (isset($migrated[$newKey])) {
                $migrated[$newKey]['qty'] += (int) ($item['qty'] ?? 0);
                if (!empty($item['note'])) {
                    $migrated[$newKey]['note'] = $item['note'];
                }
            } else {
                $migrated[$newKey] = $item;
            }
        }

        return CartOrder::ensure($migrated);
    }
}
