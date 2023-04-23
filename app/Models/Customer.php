<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function purchase(Store $store, Product $product, int $amount): bool
    {
        // $inventory = $store->getInventory($product);
        if ($store->hasEnoughInventory($product, $amount)) {
            $store->addInventory($product, $amount * (-1));
            return true;
        } else {
            return false;
        }
    }
}
