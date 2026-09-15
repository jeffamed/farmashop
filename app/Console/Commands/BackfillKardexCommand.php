<?php

namespace App\Console\Commands;

use App\Enums\KardexTypes;
use App\Models\Product;
use Illuminate\Console\Command;

class BackfillKardexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:backfill-kardex-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill the kardex information, with the stock current in the table products, note: execute only once';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Backfilling kardex...');

        $products = Product::all();
        foreach ($products as $product) {
            $product->kardex()->create([
                'type' => KardexTypes::IN->value,
                'quantity' => $product->stock,
                'stock' => $product->stock,
            ]);
        }
    }
}
