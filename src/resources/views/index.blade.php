@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="container mt-5 text-center">
        <h1 class="mb-5">Добро пожаловать в админку</h1>

        <div class="d-grid gap-3" style="max-width: 400px; margin: 0 auto;">
            <a href="{{ route('categories.index') }}" class="btn btn-outline-primary btn-lg py-4 fs-5">
                Категории
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-outline-success btn-lg py-4 fs-5">
                Товары
            </a>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-info btn-lg py-4 fs-5">
                Заказы
            </a>
        </div>
    </div>
@endsection
