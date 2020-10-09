@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- incluimos un include  -->

            @include('includes.message')

            <!-- hacemos un for que nos recorra las imagenes  -->
            @foreach ($images as $image)

            <!-- insertamos el include con la vista de las imagenes -->

            @include('includes.image' , ['image'=>$image])

            @endforeach

            <!-- hacemos la paginacion -->
            <div class="clearfix"></div>
            {{$images->links()}}

        </div>
    </div>
</div>
@endsection