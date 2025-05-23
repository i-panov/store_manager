@php
    $breadcrumbs = [
        ['name' => 'Главная', 'url' => '/'],
        ['name' => 'Товары']
    ];
@endphp

@extends('layouts.app')
@section('title', 'Товары')

@section('content')
    <div class="mb-4 text-end">
        <a href="{{ route('products.create') }}" class="btn btn-primary">+ Добавить товар</a>
    </div>

    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
                <th scope="col">Категория</th>
                <th scope="col" class="text-end">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->formattedPrice() }}</td>
                    <td>{{ $product->category?->name ?? '—' }}</td>
                    <td class="text-end">
                        <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-outline-info btn-sm me-1">
                            Просмотреть
                        </a>
                        <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-outline-primary btn-sm me-1">
                            Изменить
                        </a>
                        <form action="{{ route('products.destroy', ['id' => $product->id]) }}"
                              method="POST"
                              class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection
