<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertFalse;

use App\Models\Customer;
use App\Models\Store;
use App\Models\Product;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_十分な在庫があれば購入が成功する(): void
    {
        $store = new Store();
        $store->addInventory(Product::Shampoo, 10);
        $customer = new Customer();

        $success = $customer->purchase($store, Product::Shampoo, 5);

        assertTrue($success);
        assertEquals(5, $store->getInventory(Product::Shampoo));
    }

    public function test_十分な在庫があれば購入が成功する_with_mock(): void
    {
        $store = $this->createMock(Store::class);
        $store->method('getInventory')->willReturn(10);
        $store->method('hasEnoughInventory')->willReturn(true);
        $customer = new Customer();
        $store->expects($this->once())->method('removeInventory');
        $success = $customer->purchase($store, Product::Shampoo, 5);
        assertTrue($success);
    }

    public function test_十分な在庫がなければ購入が失敗する(): void
    {
        $store = new Store();
        $store->addInventory(Product::Shampoo, 10);
        $customer = new Customer();

        $success = $customer->purchase($store, Product::Shampoo, 15);

        assertFalse($success);
        assertEquals(10, $store->getInventory(Product::Shampoo));
    }

    public function test_十分な在庫がなければ購入が失敗する_with_mock(): void
    {
        $store = $this->createMock(Store::class);
        $store->method('getInventory')->willReturn(3);
        $store->method('hasEnoughInventory')->willReturn(false);
        $customer = new Customer();
        $store->expects($this->never())->method('removeInventory');
        $success = $customer->purchase($store, Product::Shampoo, 5);
        assertFalse($success);
    }

}
