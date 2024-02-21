<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    public function __construct(private int $id)
    {
        $this->id = $id;

    }

    public function getAllOrders(): Collection
    {
        $allOrders = Order::query()->get(['product_id', 'date', 'from', 'to']);

        return $allOrders;
    }
    public function getProductId(int $id): int
    {
        $productId = Order::query()->find($id)->get('product_id');

        return $productId[0]['product_id'];
    }
    public function getDate(int $id): string
    {
        $dateOfOrder = Order::query()->find($id)->get('date');

        return $dateOfOrder[0]['date'];
    }
    public function getFrom(int $id): int
    {
        $from = Order::query()->find($id)->get('from');

        return $from[0]['from'];
    }
    public function getToCustomer(int $id): int
    {
        $toCustomer = Order::query()->find($id)->get('to_customer');

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