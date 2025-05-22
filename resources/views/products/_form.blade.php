@csrf

<div class="mx-auto bg-white p-6 rounded shadow border space-y-6">

    <div>
        <label for="name" class="block text-sm mb-1">Название *</label>
        <input type="text" name="name" id="name"
               value="{{ old('name', $product->name ?? '') }}"
               class="w-full rounded-lg">
        @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category_id" class="block text-sm mb-1">Категория *</label>
        <select name="category_id" id="category_id" class="w-full rounded-lg">
            <option value="" disabled @selected(!old('category_id', $product->category_id ?? null))>
                Выберите категорию
            </option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $product->category_id ?? '') == $category->id)
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm mb-1">Описание</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full rounded-lg">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="price" class="block text-sm mb-1">Цена (₽) *</label>
        <input type="number" name="price" id="price" step="0.01" min="0"
               value="{{ old('price', $product->price ?? '') }}"
               class="w-full rounded-lg">
        @error('price')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end pt-2">
        <button type="submit"
                class="inline-flex items-center px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            {{ $submit ?? 'Сохранить' }}
        </button>
    </div>

</div>
