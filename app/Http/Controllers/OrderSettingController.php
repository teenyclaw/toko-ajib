<?php

namespace App\Http\Controllers;

use App\Models\StoreSetting;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderSettingController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    public function edit()
    {
        $settings   = StoreSetting::current();
        $catalogUrl = $this->orderService->catalogUrl();
        $shareUrl   = $this->orderService->buildCatalogShareWhatsAppUrl();

        return view('settings.order', compact('settings', 'catalogUrl', 'shareUrl'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'store_name'            => 'required|string|max:255',
            'store_whatsapp'        => 'nullable|string|max:30',
            'catalog_share_message' => 'nullable|string|max:1000',
        ]);

        $settings = StoreSetting::current();
        $settings->update([
            'store_name'            => $validated['store_name'],
            'store_whatsapp'        => $validated['store_whatsapp'] ?: null,
            'catalog_share_message' => $validated['catalog_share_message'] ?: null,
        ]);

        return redirect()->route('settings.order')->with('success', 'Pengaturan pesanan online disimpan.');
    }
}
