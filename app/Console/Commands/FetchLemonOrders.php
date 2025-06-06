<?php

namespace App\Console\Commands;

use App\Models\LemonSqueezyOrder;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchLemonOrders extends Command
{
    protected $signature = 'lemon:fetch-orders';

    protected $description = 'Récupère les commandes depuis l’API Lemon Squeezy';

    /**
     * @throws ConnectionException
     */
    public function handle()
    {
        $this->info('📦 Récupération des commandes...');

        $response = Http::withToken(env('LEMON_SQUEEZY_API_KEY'))
            ->accept('application/vnd.api+json')
            ->get('https://api.lemonsqueezy.com/v1/orders');

        if ($response->failed()) {
            $this->error('❌ Erreur : '.$response->status());
            Log::error('Lemon Squeezy API Error', ['response' => $response->json()]);

            return 1;
        }

        $orders = $response->json('data') ?? [];

        if (empty($orders)) {
            $this->warn('Aucune commande trouvée.');

            return 0;
        }

        foreach ($orders as $order) {
            $orderId = $order['id'];

            if (LemonSqueezyOrder::query()->where('lemon_squeezy_id', $orderId)->getModel()->exists) {
                $this->warn("⏭️ Commande déjà enregistrée : $orderId");

                continue;
            }

            $attributes = $order['attributes'];

            LemonSqueezyOrder::query()->create([
                'id' => $orderId,
                'billable_type' => $order['type'],
                'billable_id' => $attributes['first_order_item']['id'],
                'lemon_squeezy_id' => $orderId,
                'customer_id' => $attributes['customer_id'],
                'identifier' => $attributes['identifier'],
                'product_id' => $attributes['first_order_item']['product_id'],
                'variant_id' => $attributes['first_order_item']['variant_id'],
                'order_number' => $attributes['order_number'],
                'currency' => $attributes['currency'],
                'subtotal' => $attributes['subtotal'],
                'discount_total' => $attributes['discount_total'],
                'tax' => $attributes['tax'],
                'total' => $attributes['total'],
                'tax_name' => $attributes['tax_name'],
                'status' => $attributes['status'],
                'receipt_url' => $attributes['urls']['receipt'],
                'refunded' => $attributes['refunded'],
                'refunded_at' => $attributes['created_at'],
                'ordered_at' => $attributes['first_order_item']['created_at'],
            ]);

            $this->info("✅ Commande enregistrée : {$orderId} ({$attributes['order_number']})");
        }

        $this->info('✅ '.count($orders).' commande(s) récupérée(s).');

        return 0;
    }
}
