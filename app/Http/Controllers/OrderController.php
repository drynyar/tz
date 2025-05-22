<?php

namespace App\Http\Controllers;

use App\DTOs\OrderDTO;
use App\Http\Requests\SaveOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class OrderController extends Controller
{

    /**
     * @param OrderService $orderService
     */
    public function __construct(private readonly OrderService $orderService)
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('orders.index')->with([
            'orders' => Order::with('product')->orderByDesc('created_at')->simplePaginate(10)
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('orders.create')->with([
            'products' => Product::with('category')->get(),
        ]);
    }

    /**
     * @param SaveOrderRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(SaveOrderRequest $request): RedirectResponse
    {
        return rescue(
            function () use ($request) {
                $this->orderService->create(OrderDTO::fromArray($request->validated()));

                return redirect()->route('order.index')->with('message', 'Заказ создан!');
            },
            fn(Throwable $e) => redirect()->back()->with('error', $e->getMessage())
        );
    }

    /**
     * @param Order $order
     * @return View
     */
    public function edit(Order $order): View
    {
        return view('orders.edit')->with([
            'products' => Product::with('category')->get(),
            'order'    => $order
        ]);
    }

    /**
     * @param SaveOrderRequest $request
     * @param Order $order
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(SaveOrderRequest $request, Order $order): RedirectResponse
    {
        return rescue(
            function () use ($order, $request) {
                $this->orderService->update($order, OrderDTO::fromArray($request->validated()));

                return redirect()->route('order.index')->with('message', 'Заказ обновлён!');
            },
            fn(Throwable $e) => redirect()->back()->with('error', $e->getMessage())
        );
    }

    /**
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order): RedirectResponse
    {
        return rescue(
            function () use ($order) {
                $this->orderService->delete($order);

                return redirect()->route('order.index')->with('message', 'Заказ удалён!');
            },
            fn(Throwable $e) => redirect()->back()->with('error', $e->getMessage())
        );
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     * @throws Throwable
     */
    public function complete(Request $request, Order $order): RedirectResponse
    {
        return rescue(
            function () use ($order, $request) {
                $this->orderService->complete($order);

                return redirect()->route('order.index')->with('message', 'Заказ завершён!');
            },
            fn(Throwable $e) => redirect()->back()->with('error', $e->getMessage())
        );
    }
}
