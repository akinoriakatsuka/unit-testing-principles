<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caluculator extends Model
{
    use HasFactory;

    public function Sum(float $first, float $second): float
    {
        return $first + $second;
    }
}
