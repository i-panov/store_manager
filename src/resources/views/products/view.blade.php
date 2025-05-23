@php
    $breadcrumbs = [
        ['name' => 'Главная', 'url' => '/'],
        ['name' => 'Товары', 'url' => route('products.index')],
        ['name' => $product->name]
    ];
@endphp

@extends('layouts.app')
@section('title', 'Товары - ' . $product->name)

@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2 class="mb-4">{{ $product->name }}</h2>

            <div class="row g-3">
                <div class="col-md-6">
                    <p><strong>Категория:</strong> {{ $product->category?->name ?? '—' }}</p>
                </div>

                <div class="col-md-6">
                    <p><strong>Цена:</strong> {{ $product->formattedPrice() }}</p>
                </div>

                <div class="col-12">
                    <p><strong>Описание:</strong></p>
                    <div class="border rounded p-3 bg-light">
                        {{ $product->description ?? 'Нет описания' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-outline-primary me-2">
            Изменить
        </a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            Назад к списку
        </a>
    </div>
@endsection
