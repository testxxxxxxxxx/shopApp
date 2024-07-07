<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    public function getAllOrders(): Collection
    {
        $allOrders = Order::query()->get(['product_id', 'date', 'from', 'to']);

        return $allOrders;
    }
    public function getProductId(int $userId): int
    {
        $productId = Order::query()->where('from', $userId)->get('product_id');

        return $productId[0]['product_id'];
    }
    public function getDate(int $userId): string
    {
        $dateOfOrder = Order::query()->where('from', $userId)->get('date');

        return $dateOfOrder[0]['date'];
    }
    public function getFrom(int $userId): int
    {
        $from = Order::query()->where('from', $userId)->get('from');

        return $from[0]['from'];
    }
    public function getToCustomer(int $userId): int
    {
        $toCustomer = Order::query()->where('from', $userId)->get('to_customer');

        return $toCustomer[0]['to_customer'];
    }
    public function create(int $productId, string $date, int $from, int $toCustomer): int
    {
        $orderIsCreated = Order::query()->insertGetId([

            'product_id' => $productId,
            'date' => $date,
            'from' => $from,
            'to_customer' => $toCustomer,

        ]);

        return $orderIsCreated;
    }
    public function update(int $id, int $productId, int $from, int $toCustomer): int
    {
        $orderIsUpdated = Order::query()->where('id', $id)->update(['productId' => $productId, 'from' => $from, 'to_customer' => $toCustomer]);

        return $orderIsUpdated;
    }
    public function delete(int $id): int
    {
        $orderIsDeleted = Order::query()->where('id', $id)->delete();

        return $orderIsDeleted;
    }

}