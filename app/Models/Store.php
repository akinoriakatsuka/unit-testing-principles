<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    private $inventory = [];

    public function addInventory(Product $product, int $amount): int
    {
        if (isset($this->inventory[$product->name])) {
            return $this->inventory[$product->name] += $amount;
        } else {
            return $this->inventory[$product->name] = $amount;
        }
    }

    public function removeInventory(Product $product, int $amount): false | int
    {
        if (isset($this->inventory[$product->name])) {
            return $this->inventory[$product->name] -= $amount;
        } else {
            return false;
        }
    }

    public function getInventory(Product $product): ?int
    {
        return isset($this->inventory[$product->name]) ? $this->inventory[$product->name] : null;
    }

    public function hasEnoughInventory(Product $product, int $amount): bool
    {
        return $this->getInventory($product) >= $amount;
    }
}
