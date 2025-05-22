<x-layout>
    <h1 class="text-2xl font-semibold mb-6">Создание продукта</h1>

    <form action="{{ route('product.store') }}" method="POST">
        @include('products._form', ['submit' => 'Создать'])
    </form>
</x-layout>
