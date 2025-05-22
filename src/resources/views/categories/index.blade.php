@php
    $breadcrumbs = [
        ['name' => 'Главная', 'url' => route('categories.index')],
        ['name' => 'Категории']
    ];
@endphp

@extends('layouts.app')
@section('title', 'Категории')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('categories.create') }}" method="POST" class="mb-5">
            @csrf
            <div class="row align-items-center g-3">
                <div class="col-md-6 col-sm-8">
                    <input type="text"
                           name="create_name"
                           value="{{ old('create_name') }}"
                           placeholder="Название новой категории"
                           class="form-control @error('create_name') is-invalid @enderror">

                    @error('create_name')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </div>
        </form>

        <ul class="list-group list-group-flush">
            @foreach ($categories as $category)
                <li class="list-group-item py-2 px-0">
                    <div class="d-flex flex-wrap align-items-start gap-3">
                        <div style="flex: 1 1 300px; min-width: 300px;">
                            <form action="{{ route('categories.update', ['id' => $category->id]) }}"
                                id="form-update-{{ $category->id }}"
                                method="POST"
                                class="position-relative mb-2">
                                @csrf
                                @method('PUT')

                                <input type="text"
                                       name="update_name[{{ $category->id }}]"
                                       value="{{ old('update_name.'.$category->id, $category->name) }}"
                                       placeholder="Название"
                                       class="form-control @error('update_name.'.$category->id) is-invalid @enderror">

                                @error('update_name.' . $category->id)
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="visually-hidden">Изменить</button>
                            </form>
                        </div>

                        <div class="d-flex gap-2 align-items-end mt-2 mt-md-0">
                            <button form="form-update-{{ $category->id }}" type="submit" class="btn btn-success btn-sm">
                                Изменить
                            </button>

                            <form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="POST" class="mb-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-4">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
