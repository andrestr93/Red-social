@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- incluimos un include  -->

            @include('includes.message')



            <div class="card pub_image pub-image-detail">

                <div class="card-header">


                    <!-- visualizamos el avatar -->

                    @if($image->user->image)
                    <div class="container-avatar">

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
                        <img src="{{ route('image.file' , ['filename' => $image->image_path]) }}" />
                    </div>

                    <p>{{$image->description}}</p>
                    <div class="likes">
                        <?php $checklike = false ?>
                        <!-- para dtectar el like  -->
                        <!-- Primero hacemos un bucle recorriendo los likes -->
                        @foreach($image->likes as $like)

                        <!-- hacemos una ocndicion que si el usuario actual registrado con su id es igual que el id del que ha dado el like  -->
                        <!-- la variable se pone a true  -->
                        @if($like->user->id== Auth::user()->id)

                        <?php $checklike = true ?>
                        @endif
                        @endforeach

                        <!-- comprobamos que si checklike es true entonces se pone el corazon rojo  -->
                        @if($checklike)

                        <img src="{{asset('img/heartred.png')}}" class="btn-dislike"  data-id="{{$image->id}}"/>

                        <!-- si no se pone el corazon normal  -->
                        @else
                        <img src="{{asset('img/heartgray.png')}}" class="btn-like" data-id="{{$image->id}}"/>

                        @endif
                        {{count($image->likes)}}
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="comment">

                    <h3> Comentarios ({{count($image->comments)}}) </h3>

                    <hr />

                    <form method="POST" action="{{ route('comment.save') }}">
                        @csrf

                        <input type="hidden" name="image_id" value="{{$image->id}}" />
                        <p>
                            <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                                name="content"></textarea>
                            @if($errors->has('content'))

                            <!-- esto muestra que si hay algun error lo notifica  -->
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                            @endif
                        </p>
                        <button type="submit" class="btn btn-success">
                            Enviar
                        </button>
                    </form>

                    @foreach($image->comments as $comment)

                    <hr />
                    <div class="comment">

                        <span>{{$comment->content. ' | | '. $comment->user->nick .' | | '. $comment->created_at}}</span>

                            <!-- esta condicion nos indica que cuando el usuario esta identificado con Auth::check 
                            y el id del comentario es el mismo que el del usuario identificado o que el usuario de la imagen sea el mismo 
                                   que esta identificado -->                    
                        @if( Auth::check() && ( $comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id ) )
                        <!-- el boton -->
                        <a href="{{route('comment.delete' , ['id' => $comment->id])}}" class="btn btn-danger btn-sm">
                            Eliminar
                        </a>
                        @endif



                    </div>

                    @endforeach
                </div>

            </div>
        </div>
    </div>
    @endsection