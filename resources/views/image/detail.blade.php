@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- incluimos un include  -->

            @include('includes.message')

        

            <div class="card pub_image">

                <div class="card-header">


                    <!-- visualizamos el avatar -->

                    @if($image->user->image)
                    <div class = "container-avatar">

                        <img src="{{route('user.avatar' , ['filename' =>$image->user->image]) }}" class="avatar2" />
                    </div>

             
                    @endif

                    <a href="{{route ('image.detail' , ['id' => $image->id])}}">
                    <div class="data-user">

                        <!-- visualizamos el nick  -->
                        <p>{{$image->user->nick}}</p>

                    </div>
                    </a>

                </div>

                <div class="card-body">

                    <!-- visualizamos las imagenes -->
                        <div class="image-container">
                            <img src="{{ route('image.file' , ['filename' => $image->image_path]) }}"/>
                        </div>

                    
                    <div class="likes" >
                   <img src="{{asset('img/heartgray.png')}}"/>
                    </div>

                </div>

                <p>{{$image->description}}</p>

                <a href="" class="btn btn-sm btn-warning btn-coments">
                    Comentarios ({{count($image->comments)}})

                </a>

            </div>
    </div>
</div>
@endsection
