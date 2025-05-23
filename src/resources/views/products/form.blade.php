@extends('layouts.app')

@section('title', $product ?? false ? 'Редактировать ' . $product->name : 'Добавить товар')

@section('breadcrumbs')
@php
    $breadcrumbs = [
        ['name' => 'Главная', 'url' => route('products.index')],
        ['name' => 'Товары', 'url' => route('products.index')],
        ['name' => $product ?? false ? 'Редактирование "' . $product->name . '"' : 'Добавление товара']
    ];
@endphp
@endsection

@section('content')
    <div class="container mt-4">
        <h2>
            {{ $product ?? false ? 'Редактировать "' . $product->name . '"' : 'Добавить товар' }}
        </h2>

        <form
            action="{{ $product ?? false ? route('products.update', ['id' => $product->id]) : route('products.store') }}"
            method="POST"
            class="needs-validation"
            novalidate
        >
            @csrf
            @if ($product ?? false)
                @method('PUT')
            @endif

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="name" class="form-label">Название</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $product->name ?? '') }}"
                           class="form-control @error('name') is-invalid @enderror"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label">Цена</label>
                    <div class="input-group has-validation">
                        <input type="number"
                               name="price"
                               id="price"
                               step="0.01"
                               min="0"
                               value="{{ old('price', $product?->priceAsFloat() ?? '') }}"
                               class="form-control @error('price') is-invalid @enderror"
                               required>
                        <span class="input-group-text">₽</span>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="category_id" class="form-label">Категория</label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option selected disabled>Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? null) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Описание</label>
                    <textarea name="description"
                              id="description"
                              rows="5"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ $product ?? false ? 'Сохранить изменения' : 'Добавить товар' }}
            </button>

            @if ($product ?? false)
                <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-secondary ms-2">
                    Отмена
                </a>
            @else
                <a href="{{ route('products.index') }}" class="btn btn-link ms-2">
                    Отмена
                </a>
            @endif
        </form>
    </div>
@endsection
