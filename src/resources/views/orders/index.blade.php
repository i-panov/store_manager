@php
    $breadcrumbs = [
        ['name' => 'Главная', 'url' => '/'],
        ['name' => 'Заказы']
    ];
@endphp

@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
    <div class="container mt-4">
        <div class="mb-4 text-end">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">+ Добавить заказ</a>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Клиент</th>
                    <th scope="col">Товар</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>
                            @if ($order->product)
                                <a href="{{ route('products.show', ['id' => $order->product->id]) }}">
                                    {{ $order->product->name }}
                                </a>
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $order->product_count }}</td>
                        <td>{{ number_format($order->fullPrice(), 2, '.', ' ') }} ₽</td>
                        <td>
                            @if ($order->status === App\Models\OrderStatus::NEW)
                                <span class="badge bg-primary">Новый</span>
                            @else
                                <span class="badge bg-success">Завершён</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('orders.show', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-info me-1">
                                Просмотреть
                            </a>
                            @if ($order->status === App\Models\OrderStatus::NEW)
                                <a href="{{ route('orders.edit', ['id' => $order->id]) }}" class="btn btn-sm btn-outline-primary me-1">
                                    Изменить
                                </a>
                                <form action="{{ route('orders.destroy', ['id' => $order->id]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Удалить
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
