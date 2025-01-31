

<?php
@foreach ($products as $product)
?>

<section class="products">
    <div class="product">
        <a href="{{route('products.show',$product->id)}}"><img src="https://via.placeholder.com/300x200" alt="Producto 1"></a>
        <h3>{{$product->titular}}</h3>
        <p>20€</p>
    </div>
</section>

<?php
@endforeach

{{$products->links()}}
?>