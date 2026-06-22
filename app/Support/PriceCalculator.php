<?php

namespace App\Support;

class PriceCalculator
{
    public static function roundUp(int|float $price, int $step = 500): int
    {
        if ($price <= 0) {
            return 0;
        }

        return (int) (ceil($price / $step) * $step);
    }

    public static function calcRawPrices(
        float $hargaBeliDus,
        int $qtyPerDus,
        float $marginDus,
        string $marginDusType,
        float $marginPcs,
        string $marginPcsType,
    ): array {
        $qty = max(1, $qtyPerDus);

        $rawDus = $marginDusType === 'percent'
            ? $hargaBeliDus * (1 + $marginDus / 100)
            : $hargaBeliDus + $marginDus;

        $beliPcs = $rawDus / $qty;

        $rawPcs = $marginPcsType === 'percent'
            ? $beliPcs * (1 + $marginPcs / 100)
            : $beliPcs + $marginPcs;

        return [
            'raw_dus' => $rawDus,
            'raw_pcs' => $rawPcs,
        ];
    }

    public static function calcSellingPrices(
        float $hargaBeliDus,
        int $qtyPerDus,
        float $marginDus,
        string $marginDusType,
        float $marginPcs,
        string $marginPcsType,
        int $roundStep = 500,
    ): array {
        $raw = self::calcRawPrices(
            $hargaBeliDus,
            $qtyPerDus,
            $marginDus,
            $marginDusType,
            $marginPcs,
            $marginPcsType,
        );

        return [
            'harga_jual_dus' => self::roundUp($raw['raw_dus'], $roundStep),
            'harga_jual_pcs' => self::roundUp($raw['raw_pcs'], $roundStep),
        ];
    }
}
