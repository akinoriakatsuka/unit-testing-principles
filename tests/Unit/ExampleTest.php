<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertFalse;

use App\Models\Customer;
use App\Models\Store;
use App\Models\Product;
use App\Models\Caluculator;

class ExampleTest extends TestCase
{

    // public function test_十分な在庫があれば購入が成功する(): void
    // {
    //     $store = $this->createMock(Store::class);
    //     $store->method('getInventory')->willReturn(10);
    //     $store->method('hasEnoughInventory')->willReturn(true);
    //     $customer = new Customer();
    //     $store->expects($this->once())->method('removeInventory');
    //     $success = $customer->purchase($store, Product::Shampoo, 5);
    //     assertTrue($success);
    // }

    // public function test_十分な在庫がなければ購入が失敗する(): void
    // {
    //     $store = $this->createMock(Store::class);
    //     $store->method('getInventory')->willReturn(3);
    //     $store->method('hasEnoughInventory')->willReturn(false);
    //     $customer = new Customer();
    //     $store->expects($this->never())->method('removeInventory');
    //     $success = $customer->purchase($store, Product::Shampoo, 5);
    //     assertFalse($success);
    // }

    public function test_足し算(): void
    {
        $first = 10.0;
        $second = 20.0;
        $sut = new Caluculator();

        $result = $sut->sum($first, $second);
        assertEquals(30.0,$result);
    }
}
