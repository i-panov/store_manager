@extends('layouts.app')

@section('title', 'Заказ #' . $order->id)

@section('breadcrumbs')
@php
    $breadcrumbs = [
        ['name' => 'Главная', 'url' => '/'],
        ['name' => 'Заказы', 'url' => route('orders.index')],
        ['name' => 'Заказ #' . $order->id]
    ];
@endphp
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Клиент:</strong> {{ $order->customer_name }}</p>
                <p><strong>Товар:</strong> {{ optional($order->product)->name ?? 'Не указан' }}</p>
                <p><strong>Цена за штуку:</strong> {{ number_format($order->product_price, 0, '', ' ') }} ₽</p>
                <p><strong>Количество:</strong> {{ $order->product_count }}</p>
                <p><strong>Общая сумма:</strong> {{ number_format($order->fullPrice(), 0, '', ' ') }} ₽</p>
                <p><strong>Статус:</strong>
                    @if ($order->status === App\Models\OrderStatus::NEW)
                        Новый
                    @else
                        Завершён
                    @endif
                </p>
                <p><strong>Комментарий:</strong> {{ $order->comment ?? '—' }}</p>
            </div>
        </div>

        <div class="mt-3">
            @if ($order->status === \App\Models\OrderStatus::NEW)
                <a href="{{ route('orders.edit', ['id' => $order->id]) }}" class="btn btn-outline-primary me-2">
                    Изменить
                </a>
                <form action="{{ route('orders.complete', ['id' => $order->id]) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success me-2">Завершить</button>
                </form>
            @endif

            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Назад к списку</a>
        </div>
    </div>
@endsection
