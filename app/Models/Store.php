<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    private $inventory = [];

    public function AddInventory(Product $product,int $amount) : void {
        if(isset($this->inventory[$product->name])) {
            $this->inventory[$product->name] += $amount;
        } else {
            $this->inventory[$product->name] = $amount;
        }
    }

    public function getInventory(Product $product) : int | null {
        return isset($this->inventory[$product->name]) ? $this->inventory[$product->name] : null;
    }
}
