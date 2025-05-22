<?php

namespace App\DTOs;

use App\Enums\OrderStatus;
use WendellAdriel\ValidatedDTO\Casting\EnumCast;
use WendellAdriel\ValidatedDTO\Casting\IntegerCast;
use WendellAdriel\ValidatedDTO\Casting\StringCast;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class OrderDTO extends SimpleDTO
{
    public string $customer_name;
    public ?OrderStatus $status;
    public ?string $customer_note;
    public ?int $product_id;

    /**
     * @return array
     */
    protected function defaults(): array
    {
        return [];
    }

    /**
     * @return array
     */
    protected function casts(): array
    {
        return [
            'customer_name' => new StringCast(),
            'status'        => new EnumCast(OrderStatus::class),
            'customer_note' => new StringCast(),
            'product_id'    => new IntegerCast(),
        ];
    }
}
