@extends('layouts.plantilla_user_menu')

@section('title', 'Mis Productos')


<link rel="stylesheet" href="{{ asset('css/style_myproducts.css') }}?v={{ time() }}">

@section('context')
<div class="container">
    <main class="main-content">
        <h1>Mis Productos</h1>
        <button class="add-product">Añadir Producto</button>
        <div class="product-list">
            <div class="product-item">
                <div class="product-image"></div>
                <div class="product-details">
                    <h2>¡Hacer una casa a partir de un plano! - Blender 3D para principiantes</h2>
                    <p class="price">20€</p>
                    <button class="edit-product">Editar Producto</button>
                </div>
            </div>
            <div class="product-item">
                <div class="product-image"></div>
                <div class="product-details">
                    <h2>¡Hacer una casa a partir de un plano! - Blender 3D para principiantes</h2>
                    <p class="price">5€</p>
                    <button class="edit-product">Editar Producto</button>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
    


