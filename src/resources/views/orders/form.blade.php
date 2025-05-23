@extends('layouts.app')

@section('title', $order ?? false ? 'Редактировать заказ #' . $order->id : 'Добавить заказ')

@section('breadcrumbs')
@php
    $breadcrumbs = [
        ['name' => 'Главная', 'url' => '/'],
        ['name' => 'Заказы', 'url' => route('orders.index')],
        ['name' => $order ?? false ? 'Редактирование' : 'Создание']
    ];
@endphp
@endsection

@section('content')
    <div class="container mt-4">
        <h2>{{ $order ?? false ? 'Редактировать заказ' : 'Новый заказ' }}</h2>

        <form action="{{ $order ?? false ? route('orders.update', ['id' => $order->id]) : route('orders.store') }}" method="POST">
            @csrf
            @if ($order ?? false)
                @method('PUT')
            @endif

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="customer_name" class="form-label">Имя клиента</label>
                    <input type="text"
                           name="customer_name"
                           id="customer_name"
                           value="{{ old('customer_name', $order?->customer_name ?? '') }}"
                           class="form-control @error('customer_name') is-invalid @enderror">
                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if ($order ?? false)
                    <div class="col-md-6">
                        <label class="form-label">Товар</label>
                        <p class="form-control-plaintext">{{ $order->product?->name ?? '—' }}</p>
                    </div>
                @else
                    <div class="col-md-6">
                        <label for="product_id" class="form-label">Выберите товар</label>
                        <select name="product_id" id="product_id" class="form-select @error('product_id') is-invalid @enderror" required>
                            <option selected disabled>Выберите товар</option>
                            @foreach ($products as $id => $name)
                                <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <div class="col-md-6">
                    <label for="product_count" class="form-label">Количество</label>
                    <input type="number"
                           name="product_count"
                           id="product_count"
                           min="0"
                           value="{{ old('product_count', $order->product_count ?? '') }}"
                           class="form-control @error('product_count') is-invalid @enderror">
                    @error('product_count')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="comment" class="form-label">Комментарий</label>
                    <textarea name="comment"
                              id="comment"
                              rows="4"
                              class="form-control @error('comment') is-invalid @enderror">{{ old('comment', $order->comment ?? '') }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ $order ?? false ? 'Сохранить изменения' : 'Добавить заказ' }}
            </button>

            @if ($order ?? false)
                <a href="{{ route('orders.show', ['id' => $order->id]) }}" class="btn btn-secondary ms-2">
                    Отмена
                </a>
            @else
                <a href="{{ route('orders.index') }}" class="btn btn-link ms-2">
                    Отмена
                </a>
            @endif
        </form>
    </div>
@endsection
