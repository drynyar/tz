<?php

namespace App\Http\Controllers;

use App\DTOs\ProductDTO;
use App\Http\Requests\SaveProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ProductController extends Controller
{

    /**
     * @param ProductService $productService
     */
    public function __construct(private readonly ProductService $productService)
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('products.index')->with([
            'products' => Product::with('category')->orderBy('id')->simplePaginate(10)
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('products.create')->with([
            'categories' => Category::all(),
        ]);
    }

    /**
     * @param SaveProductRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(SaveProductRequest $request): RedirectResponse
    {
        return rescue(
            function () use ($request) {
                $this->productService->create(ProductDTO::fromArray($request->validated()));

                return redirect()->route('product.index')->with('message', 'Product created successfully!');
            },
            fn(Throwable $e) => redirect()->back()->with('error', $e->getMessage())
        );
    }

    /**
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        return view('products.edit')->with([
            'categories' => Category::all(),
            'product'    => $product
        ]);
    }

    /**
     * @param SaveProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(SaveProductRequest $request, Product $product): RedirectResponse
    {
        return rescue(
            function () use ($product, $request) {
                $this->productService->update($product, ProductDTO::fromArray($request->validated()));

                return redirect()->route('product.index')->with('message', 'Product updated successfully!');
            },
            fn(Throwable $e) => redirect()->back()->with('error', $e->getMessage())
        );
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        return rescue(
            function () use ($product) {
                $this->productService->delete($product);

                return redirect()->route('product.index')->with('message', 'Product deleted successfully!');
            },
            fn(Throwable $e) => redirect()->back()->with('error', $e->getMessage())
        );
    }
}
