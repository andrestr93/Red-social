@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- incluimos un include  -->

            @include('includes.message')

            <!-- hacemos un for que nos recorra las imagenes  -->
            @foreach ($images as $image)

            <div class="card pub_image">

                <div class="card-header">
                    <!-- visualizamos el avatar -->

                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{route('user.avatar' , ['filename' =>$image->user->image]) }}" class="avatar2" />
                    </div>


                    @endif

                    <div class="data-user">

                        <!-- visualizamos el nick  -->
                        <p>{{$image->user->nick}}</p>

                    </div>


                </div>

                <div class="card-body">

                    <!-- visualizamos las imagenes -->

                    <div class="image-container">
                        <a href="{{ route ('image.detail', ['id'=>$image->id])}}">
                            <img src="{{ route('image.file' , ['filename' => $image->image_path]) }}" />
                        </a>
                    </div>


                    <div class="likes">
                        <img src="{{asset('img/heartgray.png')}}" />
                    </div>

                </div>

                <p>{{$image->description}}</p>
                <span>{{$image->created_at}}</span>
           


                <a href="" class="btn btn-sm btn-warning btn-coments">
                    Comentarios ({{count($image->comments)}})

                </a>

            </div>



            @endforeach

            <!-- hacemos la paginacion -->
            <div class="clearfix"></div>
            {{$images->links()}}

        </div>
    </div>
</div>
@endsection