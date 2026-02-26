@extends('layouts.app')

@section('title', isset($product) ? 'Editar Producto' : 'Crear Producto')

@section('header', isset($product) ? 'Editar Producto' : 'Crear Producto')

@section('content')
    <div class="container mx-auto max-w-md bg-white">
        <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}"
              method="post">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $product->name ?? '') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       required>
                @error('name')
                <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Descripcion:</label>
                <textarea name="description" id="description" cols="30" rows="10"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $product->description ?? '') }}</textarea>
                @error('description')
                <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Precio:</label>
                <input type="number" name="price" id="price" step="0.01"
                       value="{{ old('price', $product->price ?? '') }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       required>
                @error('price')
                <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="is_active" class="block text-gray-700 text-sm font-bold mb-2">Estado:</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" id="is_active" value="1" class="sr-only peer"
                        {{ old('is_active', $product->is_active ?? 1) ? 'checked' : '' }}>
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-700">Activo</span>
                </label>
                @error('is_active')
                <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ isset($product) ? 'Actualizar' : 'Crear' }}
                </button>
                <a href="{{route('products.index')}}"
                   class="inline-block align-baseline font-bold text-sm bg-gray-500 hover:bg-gray-700 text-black py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Volver
                </a>
            </div>
        </form>

        @if(isset($product))
            <div class="mt-4">
                <form action="{{route('products.destroy', $product)}}" method="post"
                      onsubmit="return confirm('¿Estás seguro?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Eliminar Producto
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
