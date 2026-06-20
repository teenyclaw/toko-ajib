<?php

namespace App\Support;

class OrderSessionCart
{
    public const SESSION_KEY = 'order_cart';

    public static function get(): array
    {
        return session()->get(self::SESSION_KEY, []);
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
}
