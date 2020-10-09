@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <h1>Mis imagenes favoritas</h1>

            <hr />
            <!-- recorremos las imagenes favoritas del usuario logueado -->
            @foreach($likes as $like)

            <!-- pasandole las imagenes nos saca las imagenes favoritas -->
            @include('includes.image' , ['image'=>$like->image])

            @endforeach


            <!-- hacemos la paginacion -->
            <div class="clearfix"></div>
            {{$likes->links()}}
        </div>
    </div>
</div>
@endsection