<x-layout>
    <h1 class="text-2xl font-semibold mb-6">Создание заказа</h1>

    <form action="{{ route('order.store') }}" method="POST">
        @include('orders._form', ['submit' => 'Создать'])
    </form>
</x-layout>
