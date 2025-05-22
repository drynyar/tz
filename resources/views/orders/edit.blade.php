<x-layout>
    <h1 class="text-2xl font-semibold mb-6">Редактирование заказа</h1>

    <form action="{{ route('order.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('orders._form', ['submit' => 'Сохранить'])
    </form>
</x-layout>
