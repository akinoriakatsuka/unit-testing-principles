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
        $store->AddInventory(Product::Shampoo, 10);
        $customer = new Customer();

        $success = $customer->Purchase($store, Product::Shampoo, 5);

        assertTrue($success);
        assertEquals(5, $store->GetInventory(Product::Shampoo));
    }

    public function test_十分な在庫があれば購入が成功する_with_mock(): void
    {
        $store_mock = $this->createMock(Store::class);
        $store_mock->method('GetInventory')->willReturn(10);
        $customer = new Customer();
        $success = $customer->Purchase($store_mock, Product::Shampoo, 5);
        assertTrue($success);
    }

    public function test_十分な在庫がなければ購入が失敗する(): void
    {
        $store = new Store();
        $store->AddInventory(Product::Shampoo, 10);
        $customer = new Customer();

        $success = $customer->Purchase($store, Product::Shampoo, 15);

        assertFalse($success);
        assertEquals(10, $store->GetInventory(Product::Shampoo));
    }

    public function test_十分な在庫がなければ購入が失敗する_with_mock(): void
    {
        $store_mock = $this->createMock(Store::class);
        $store_mock->method('GetInventory')->willReturn(3);
        $customer = new Customer();
        $success = $customer->Purchase($store_mock, Product::Shampoo, 5);
        assertFalse($success);
    }

}
