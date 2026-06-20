<?php

namespace App\Support;

class CartOrder
{
    public static function next(array $cart): int
    {
        $orders = array_column($cart, 'order');

        return empty($orders) ? 0 : max($orders) + 1;
    }

    public static function ensure(array $cart): array
    {
        $max = -1;
        foreach ($cart as $item) {
            if (isset($item['order']) && $item['order'] > $max) {
                $max = $item['order'];
            }
        }

        $next = $max + 1;
        foreach ($cart as &$item) {
            if (!isset($item['order'])) {
                $item['order'] = $next++;
            }
        }
        unset($item);

        return self::sort($cart);
    }

    public static function sort(array $cart): array
    {
        uasort($cart, fn($a, $b) => ($a['order'] ?? 0) <=> ($b['order'] ?? 0));

        return $cart;
    }
}
