<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\Casting\FloatCast;
use WendellAdriel\ValidatedDTO\Casting\IntegerCast;
use WendellAdriel\ValidatedDTO\Casting\StringCast;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class ProductDTO extends SimpleDTO
{
    public string $name;
    public ?string $description;
    public float $price;
    public int $category_id;

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
            'name'        => new StringCast(),
            'description' => new StringCast(),
            'price'       => new FloatCast(),
            'category_id' => new IntegerCast(),
        ];
    }
}
