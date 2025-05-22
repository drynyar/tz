<?php

namespace App\Services;

use App\DTOs\ProductDTO;
use App\Models\Product;

final readonly class ProductService
{

    /**
     * @param ProductDTO $productDTO
     * @return Product
     */
    public function create(ProductDTO $productDTO): Product
    {
        $product = new Product;
        $product->fill($productDTO->toArray());
        $product->category()->associate($productDTO->category_id);

        $product->save();

        return $product;
    }


    /**
     * @param Product $product
     * @param ProductDTO $productDTO
     * @return Product
     */
    public function update(Product $product, ProductDTO $productDTO): Product
    {
        $product->category()->associate($productDTO->category_id);
        $product->update($productDTO->toArray());

        return $product;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
