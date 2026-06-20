<?php

namespace App\Support;

use App\Models\Customer;
use Illuminate\Support\Str;

class PhoneNormalizer
{
    public static function normalize(?string $phone): ?string
    {
        if ($phone === null || trim($phone) === '') {
            return null;
        }

        $phone = preg_replace('/\D+/', '', $phone) ?? '';

        if ($phone === '') {
            return null;
        }

        if (Str::startsWith($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        if (Str::startsWith($phone, '8')) {
            $phone = '62' . $phone;
        }

        return $phone;
    }

    /**
     * Kemungkinan format nomor yang sama (62 / 0 / 8).
     *
     * @return array<int, string>
     */
    public static function variants(?string $phone): array
    {
        $normalized = self::normalize($phone);

        if (!$normalized) {
            return [];
        }

        $variants = [$normalized];

        if (Str::startsWith($normalized, '62') && strlen($normalized) > 2) {
            $national = substr($normalized, 2);
            $variants[] = '0' . $national;
            $variants[] = $national;
        }

        return array_values(array_unique($variants));
    }

    public static function findCustomer(?string $phone): ?Customer
    {
        $variants = self::variants($phone);

        if (empty($variants)) {
            return null;
        }

        return Customer::whereIn('phone', $variants)->first();
    }
}
