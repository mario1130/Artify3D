@extends('layouts.plantilla')

@section('title', 'Shopping cart')

@section('context')
<style>

    .cart{
        display: flex;
        justify-content: center; 
        align-items: center; 
        height: 50vh; 
        margin: 0;
        flex-direction: column;
    }

    .cart h1{
        font-size: 3rem;

    }

    form button {
        padding: 10px;
        font-size: 16px;
        color: #fff;
        background-color: #1D7129;
        border: 1px solid #fff;
        cursor: pointer;
        width: 18rem;
        height: 3rem;
        margin-top: 3rem;
}

</style>
<div  class="cart">
    <h1>Tu carrito esta vacío</h1> 
    <form>
        <button type="button" onclick="window.location.href='/'">Seguir Comprando</button>
    </form>
</div>



@endsection
