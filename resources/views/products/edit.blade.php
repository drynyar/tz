<x-layout>
    <h1 class="text-2xl font-semibold mb-6">Редактирование продукта</h1>

    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('products._form', ['submit' => 'Сохранить'])
    </form>
</x-layout>
