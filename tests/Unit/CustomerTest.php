<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertFalse;

use App\Models\Customer;
use App\Models\Store;
use App\Models\Product;

class CustomerTest extends TestCase
{

    public function test_十分な在庫があれば購入が成功する_古典(): void
    {
        $store = $this->createStoreWithInventory(Product::Shampoo,10);
        $sut = $this::createCustomer();

        $success = $sut->purchase($store, Product::Shampoo, 5);

        assertTrue($success);
        assertEquals(5, $store->getInventory(Product::Shampoo));
    }

    public function test_十分な在庫がなければ購入が失敗する_古典(): void
    {
        $store = $this->createStoreWithInventory(Product::Shampoo,10);
        $sut = $this::createCustomer();

        $success = $sut->purchase($store, Product::Shampoo, 15);

        assertFalse($success);
        assertEquals(10, $store->getInventory(Product::Shampoo));
    }

    public function test_十分な在庫があれば購入が成功する_ロンドン(): void
    {
        $store = $this->createMock(Store::class);
        $store->method('getInventory')->willReturn(10);
        $store->method('hasEnoughInventory')->willReturn(true);
        $customer = new Customer();
        $store->expects($this->once())->method('removeInventory');
        $success = $customer->purchase($store, Product::Shampoo, 5);
        assertTrue($success);
    }

    public function test_十分な在庫がなければ購入が失敗する_ロンドン(): void
    {
        $store = $this->createMock(Store::class);
        $store->method('getInventory')->willReturn(3);
        $store->method('hasEnoughInventory')->willReturn(false);
        $customer = new Customer();
        $store->expects($this->never())->method('removeInventory');
        $success = $customer->purchase($store, Product::Shampoo, 5);
        assertFalse($success);
    }

    private function createStoreWithInventory(Product $product, int $amount) {
        $store = new Store();
        $store->addInventory($product,$amount);
        return $store;
    }

    private static function createCustomer() : Customer {
        return new Customer();
    }
}
