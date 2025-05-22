<?php

namespace App\Services;

use App\DTOs\OrderDTO;
use App\Enums\OrderStatus;
use App\Models\Order;

final readonly class OrderService
{

    /**
     * @param OrderDTO $orderDTO
     * @return Order
     */
    public function create(OrderDTO $orderDTO): Order
    {
        $order = new Order;
        $order->fill($orderDTO->toArray());
        $order->product()->associate($orderDTO->product_id);

        $order->save();

        return $order;
    }


    /**
     * @param Order $order
     * @param OrderDTO $orderDTO
     * @return Order
     */
    public function update(Order $order, OrderDTO $orderDTO): Order
    {
        if ($orderDTO->product_id) $order->product()->associate($orderDTO->product_id);

        $order->update($orderDTO->toArray());

        return $order;
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function delete(Order $order): bool
    {
        return $order->delete();
    }

    /**
     * @param Order $order
     * @return Order
     */
    public function complete(Order $order): Order
    {
        $order->update(['status' => OrderStatus::COMPLETED]);

        return $order;
    }
}
