<x-layout>

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800">Список заказов</h1>
        <a href="{{ route('order.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Создать заказ
        </a>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
        <table class="min-w-full table-fixed divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
            <tr>
                <th class="w-16 px-6 py-4 text-left font-semibold text-gray-700">ID</th>
                <th class="w-24 px-6 py-4 text-left font-semibold text-gray-700">Дата создания</th>
                <th class="px-6 py-4 text-left font-semibold text-gray-700">ФИО покупателя</th>
                <th class="w-24 px-6 py-4 text-left font-semibold text-gray-700">Статус</th>
                <th class="w-24 px-6 py-4 text-left font-semibold text-gray-700">Цена</th>
                <th class="w-16 px-6 py-4 text-left font-semibold text-gray-700"></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
            @foreach ($orders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $order->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $order->created_at->locale('ru')->isoFormat('LL LTS') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $order->customer_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ $order->status->label() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">{{ \Illuminate\Support\Number::currency($order->product->price, in: 'RUB', locale: 'ru', precision: 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-600 space-x-2">
                        <a href="{{ route('order.edit', $order->id) }}"
                           class="inline-flex items-center text-blue-500 hover:text-blue-700">
                            ✏️
                        </a>
                        <form action="{{ route('order.destroy', $order->id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Вы уверены?');"
                        >
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
        {{ $orders->links() }}
    </div>
</x-layout>
