@csrf

<div class="mx-auto bg-white p-6 rounded shadow border space-y-6">

    <div>
        <label for="customer_name" class="block text-sm mb-1">ФИО покупателя *</label>
        <input type="text" name="customer_name" id="customer_name"
               value="{{ old('customer_name', $order->customer_name ?? '') }}"
               class="w-full rounded-lg">
        @error('customer_name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="created_at" class="block text-sm mb-1">Дата создания *</label>
        <input type="datetime-local" name="created_at" id="created_at"
               value="{{ old('created_at', $order->created_at ?? '') }}"
               class="w-full rounded-lg">
        @error('created_at')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="status" class="block text-sm mb-1">Статус</label>
        <select name="status" id="status" class="w-full rounded-lg" @disabled(isset($order))>
            @foreach (\App\Enums\OrderStatus::cases() as $status)
                <option value="{{ $status->value }}"
                    @selected(old('status', $order->status->value ?? \App\Enums\OrderStatus::IN_PROGRESS) === $status->value)
                >
                    {{ $status->label() }}
                </option>
            @endforeach
        </select>
        @error('status')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="product_id" class="block text-sm mb-1">Продукт *</label>
        <select name="product_id" id="product_id" class="w-full rounded-lg" @disabled(isset($order) && $order->status === \App\Enums\OrderStatus::COMPLETED)>
            <option value="" disabled @selected(!old('product_id', $order->product_id ?? null))>
                Выберите продукт
            </option>

            @foreach ($products as $product)
                <option value="{{ $product->id }}"
                    @selected(old('product_id', $order->product_id ?? '') == $product->id)
                >
                    {{ $product->name }}
                    ({{ \Illuminate\Support\Number::currency($product->price, in: 'RUB', locale: 'ru', precision: 2) }})
                </option>
            @endforeach
        </select>
        @error('product_id')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="customer_note" class="block text-sm mb-1">Комментария покупателя</label>
        <textarea name="customer_note" id="customer_note" rows="4"
                  class="w-full rounded-lg">{{ old('customer_note', $order->customer_note ?? '') }}</textarea>
        @error('customer_note')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center pt-2">
        @if(isset($order) && $order->status === \App\Enums\OrderStatus::IN_PROGRESS)
            <a href="{{ route('order.complete', $order) }}"
               onclick="return confirm('Are you sure?');"
               class="inline-flex px-5 py-2.5 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Выполнить заказ
            </a>
        @endif

        <button type="submit"
                class="inline-flex ml-auto px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
            {{ $submit ?? 'Сохранить' }}
        </button>
    </div>

</div>
