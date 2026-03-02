<?php

namespace App\Services;

use App\Models\Reimbursement;

class ReimbursementService
{
    public function __construct()
    {}

    public function registerDetails(Reimbursement $reimbursement, array $products): void
    {
        $data = collect($products)->map(fn ($product) => [
            'product_id' => $product['id'],
            'quantity' => $product['quantity'],
            'price' => $product['price'],
        ])->toArray();

        $reimbursement->details()->insert($data);
    }
}
