<x-layout>
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800">Список продуктов</h1>
        <a href="{{ route('product.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Добавить продукт
        </a>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
        <table class="min-w-full table-fixed divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left font-semibold text-gray-700">Название</th>
                <th class="w-32 px-6 py-4 text-left font-semibold text-gray-700">Цена</th>
                <th class="w-48 px-6 py-4 text-left font-semibold text-gray-700">Категория</th>
                <th class="w-16 px-6 py-4 text-left font-semibold text-gray-700"></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
            @foreach ($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ \Illuminate\Support\Number::currency($product->price, in: 'RUB', locale: 'ru', precision: 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $product->category->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-600 space-x-2">
                        <a href="{{ route('product.edit', $product->id) }}"
                           class="inline-flex items-center text-blue-500 hover:text-blue-700">
                            ✏️
                        </a>
                        <form action="{{ route('product.destroy', $product->id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Вы уверены?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="cursor-pointer inline-flex items-center text-red-500 hover:text-red-700">
                                🗑️
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</x-layout>
