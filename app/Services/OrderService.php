<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\StoreSetting;
use App\Models\Sale;
use App\Support\CartOrder;
use App\Support\OrderSessionCart;
use App\Support\PhoneNormalizer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService
{
    public function generateOrderNumber(): string
    {
        $date = now()->format('Ymd');
        $prefix = 'ORD-' . $date . '-';

        $last = Order::where('order_number', 'like', $prefix . '%')
            ->orderByDesc('id')
            ->value('order_number');

        $seq = 1;
        if ($last && preg_match('/-(\d+)$/', $last, $m)) {
            $seq = (int) $m[1] + 1;
        }

        return $prefix . str_pad((string) $seq, 3, '0', STR_PAD_LEFT);
    }

    public function findOrCreateCustomer(string $name, string $phone, ?string $address = null): Customer
    {
        $normalized = PhoneNormalizer::normalize($phone) ?? $phone;
        $customer   = PhoneNormalizer::findCustomer($phone);

        if ($customer) {
            $customer->update([
                'name'    => $name,
                'phone'   => $normalized,
                'address' => $address ?? $customer->address,
            ]);

            return $customer;
        }

        return Customer::create([
            'name'    => $name,
            'phone'   => $normalized,
            'address' => $address,
        ]);
    }

    public function normalizePhone(string $phone): string
    {
        return PhoneNormalizer::normalize($phone) ?? '';
    }

    public function storeSettings(): StoreSetting
    {
        return StoreSetting::current();
    }

    public function catalogUrl(): string
    {
        return url('/order');
    }

    public function buildCatalogShareWhatsAppUrl(): string
    {
        $settings = $this->storeSettings();
        $message  = trim($settings->catalog_share_message ?: 'Silakan pesan produk kami melalui link berikut:');
        $message .= "\n\n" . $this->catalogUrl();

        return 'https://wa.me/?text=' . rawurlencode($message);
    }

    public function buildNewOrderToStoreWhatsAppUrl(Order $order): ?string
    {
        $settings = $this->storeSettings();
        $phone    = $settings->store_whatsapp;

        if (!$phone) {
            return null;
        }

        $phone = $this->normalizePhone($phone);
        $order->loadMissing('items');

        $lines = [
            'Halo ' . $settings->store_name . ',',
            'Saya ingin konfirmasi pesanan:',
            '',
            'No: ' . $order->order_number,
            'Nama: ' . $order->customer_name,
            'Telepon: ' . $order->customer_phone,
        ];

        if ($order->customer_address) {
            $lines[] = 'Alamat: ' . $order->customer_address;
        }

        if ($order->notes) {
            $lines[] = 'Catatan: ' . $order->notes;
        }

        $lines[] = '';
        $lines[] = 'Item:';

        foreach ($order->items as $item) {
            $lines[] = '• ' . $item->product_name . ' × ' . $item->qty . ' ' . $item->unit;
        }

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode(implode("\n", $lines));
    }

    public function createFromCart(array $customerData, array $cart): Order
    {
        return DB::transaction(function () use ($customerData, $cart) {
            $customer = $this->findOrCreateCustomer(
                $customerData['name'],
                $customerData['phone'],
                $customerData['address'] ?? null
            );

            $order = Order::create([
                'order_number'     => $this->generateOrderNumber(),
                'customer_id'      => $customer->id,
                'customer_name'    => $customerData['name'],
                'customer_phone'   => $this->normalizePhone($customerData['phone']),
                'customer_address' => $customerData['address'] ?? null,
                'notes'            => $customerData['notes'] ?? null,
                'status'           => 'pending',
                'subtotal'         => 0,
                'source'           => 'web',
            ]);

            $sort = 0;
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['product_id'],
                    'product_name' => $item['name'],
                    'qty'          => $item['qty'],
                    'unit'         => $item['unit'] ?? 'pcs',
                    'price'        => null,
                    'sort_order'   => $item['order'] ?? $sort,
                ]);
                $sort++;
            }

            OrderSessionCart::clear();

            return $order->load('items');
        });
    }

    public function addProductToCart(Product $product, int $qty = 1, string $unit = 'pcs'): array
    {
        if (!$product->is_orderable) {
            throw new \InvalidArgumentException('Produk tidak tersedia untuk pemesanan online.');
        }

        if ($product->stock <= 0) {
            throw new \InvalidArgumentException('Stok produk habis.');
        }

        $cart = OrderSessionCart::get();
        $id   = (string) $product->id;

        if (isset($cart[$id])) {
            $newQty = $cart[$id]['qty'] + $qty;
            if ($newQty > $product->stock) {
                throw new \InvalidArgumentException('Qty melebihi stok tersedia (' . $product->stock . ').');
            }
            $cart[$id]['qty'] = $newQty;
        } else {
            if ($qty > $product->stock) {
                throw new \InvalidArgumentException('Qty melebihi stok tersedia (' . $product->stock . ').');
            }
            $cart[$id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'qty'        => $qty,
                'unit'       => $unit,
                'order'      => CartOrder::next($cart),
                'stock'      => $product->stock,
            ];
        }

        OrderSessionCart::put($cart);

        return $cart;
    }

    public function updateCartQty(string $productId, int $qty): array
    {
        $cart = OrderSessionCart::get();

        if (!isset($cart[$productId])) {
            return $cart;
        }

        $product = Product::find($productId);
        if (!$product) {
            unset($cart[$productId]);
            OrderSessionCart::put($cart);
            return $cart;
        }

        if ($qty <= 0) {
            unset($cart[$productId]);
        } else {
            if ($qty > $product->stock) {
                throw new \InvalidArgumentException('Qty melebihi stok tersedia (' . $product->stock . ').');
            }
            $cart[$productId]['qty']   = $qty;
            $cart[$productId]['stock'] = $product->stock;
        }

        OrderSessionCart::put($cart);

        return $cart;
    }

    public function removeFromCart(string $productId): array
    {
        $cart = OrderSessionCart::get();
        unset($cart[$productId]);
        OrderSessionCart::put($cart);

        return $cart;
    }

    public function orderableProductsQuery()
    {
        return Product::with('category')
            ->where('is_orderable', true)
            ->orderBy('name');
    }

    public function pendingOrdersQuery()
    {
        return Order::with(['items', 'customer'])
            ->whereIn('status', ['pending', 'processing'])
            ->orderByDesc('created_at');
    }

    public function pendingCount(): int
    {
        return Order::where('status', 'pending')->count();
    }

    public function latestPendingId(): ?int
    {
        return Order::where('status', 'pending')->latest('id')->value('id');
    }

    public function historyQuery(?string $status = null, ?string $search = null)
    {
        return Order::with(['items', 'customer', 'sale', 'confirmedBy'])
            ->when($status && $status !== 'all', fn ($q) => $q->where('status', $status))
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('order_number', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_phone', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('created_at');
    }

    public function orderStats(): array
    {
        return [
            'pending'    => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed'  => Order::where('status', 'completed')->whereDate('updated_at', today())->count(),
            'cancelled'  => Order::where('status', 'cancelled')->whereDate('updated_at', today())->count(),
        ];
    }

    public function loadToPosCart(Order $order, int $userId): array
    {
        if (!in_array($order->status, ['pending', 'processing'], true)) {
            throw new \InvalidArgumentException('Pesanan tidak dapat dimuat.');
        }

        $order->load('items.product', 'customer');
        $cart = [];
        $warnings = [];

        foreach ($order->items as $item) {
            $product = $item->product;

            if (!$product) {
                $warnings[] = $item->product_name . ' (produk tidak ditemukan)';
                continue;
            }

            if ($item->qty > $product->stock) {
                throw new \InvalidArgumentException(
                    $item->product_name . ': stok tersedia ' . $product->stock . ', pesanan ' . $item->qty
                );
            }

            $price = $item->unit === 'dus'
                ? ($product->harga_jual_dus ?? $product->harga_jual_pcs)
                : $product->harga_jual_pcs;

            $cart[$product->id] = [
                'name'      => $item->product_name,
                'price'     => (int) $price,
                'qty'       => $item->qty,
                'order'     => $item->sort_order,
                'harga_pcs' => $product->harga_jual_pcs,
                'harga_dus' => $product->harga_jual_dus ?? $product->harga_jual_pcs,
            ];

            $item->update(['price' => $price]);
        }

        if (empty($cart)) {
            throw new \InvalidArgumentException('Tidak ada item valid untuk dimuat ke keranjang.');
        }

        $cart = CartOrder::ensure($cart);
        session()->put('cart', $cart);
        session()->put('pending_order_id', $order->id);

        $order->update([
            'status'       => 'processing',
            'confirmed_by' => $userId,
            'confirmed_at' => now(),
        ]);

        $grandTotal = collect($cart)->sum(fn ($i) => $i['price'] * $i['qty']);

        return [
            'customer_id'  => $order->customer_id,
            'order_number' => $order->order_number,
            'order_id'     => $order->id,
            'cart'         => $cart,
            'grandTotal'   => $grandTotal,
            'warnings'     => $warnings,
        ];
    }

    public function releaseProcessingOrder(?int $orderId): void
    {
        if (!$orderId) {
            return;
        }

        Order::where('id', $orderId)
            ->where('status', 'processing')
            ->update([
                'status'       => 'pending',
                'confirmed_by' => null,
                'confirmed_at' => null,
            ]);
    }

    public function cancelOrder(Order $order, int $userId): void
    {
        if (!in_array($order->status, ['pending', 'processing'], true)) {
            throw new \InvalidArgumentException('Pesanan tidak dapat dibatalkan.');
        }

        $order->update([
            'status'       => 'cancelled',
            'confirmed_by' => $userId,
            'confirmed_at' => now(),
        ]);

        if ((int) session('pending_order_id') === $order->id) {
            session()->forget(['pending_order_id', 'cart']);
        }
    }

    public function completeOrder(Order $order, Sale $sale, int $userId): Order
    {
        $order->load('items');

        $order->update([
            'status'       => 'completed',
            'sale_id'      => $sale->id,
            'subtotal'     => $sale->total,
            'confirmed_by' => $userId,
            'confirmed_at' => $order->confirmed_at ?? now(),
        ]);

        $sale->load('items');

        foreach ($sale->items as $saleItem) {
            if (!$saleItem->product_id) {
                continue;
            }

            OrderItem::where('order_id', $order->id)
                ->where('product_id', $saleItem->product_id)
                ->update(['price' => $saleItem->price]);
        }

        return $order->fresh(['items', 'customer', 'sale']);
    }

    public function buildReceiptWhatsAppUrl(Sale $sale, ?string $phone = null): ?string
    {
        $phone = $phone ?? $sale->customer?->phone;

        if (!$phone) {
            return null;
        }

        $phone = preg_replace('/\D+/', '', $phone) ?? '';

        if (Str::startsWith($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        if (Str::startsWith($phone, '8')) {
            $phone = '62' . $phone;
        }

        if ($phone === '') {
            return null;
        }

        $sale->load('items.product');

        $lines = [
            'Terima kasih telah berbelanja di *' . $this->storeSettings()->store_name . '*!',
            'Invoice: ' . $sale->invoice,
            '',
            'Detail:',
        ];

        foreach ($sale->items as $item) {
            $name = $item->name ?? $item->product?->name ?? '-';
            $sub  = $item->price * $item->qty;
            $lines[] = '• ' . $name . ' × ' . $item->qty . ' = Rp ' . number_format($sub, 0, ',', '.');
        }

        $lines[] = '';
        $lines[] = 'Total: Rp ' . number_format($sale->total, 0, ',', '.');
        $lines[] = 'Bayar: Rp ' . number_format($sale->paid, 0, ',', '.');

        if ($sale->change > 0) {
            $lines[] = 'Kembalian: Rp ' . number_format($sale->change, 0, ',', '.');
        }

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode(implode("\n", $lines));
    }
}
