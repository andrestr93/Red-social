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


        <!-- visualizamos los likes  -->

        <div class="likes">
            <?php $checklike = false?>
            <!-- para dtectar el like  -->
            <!-- Primero hacemos un bucle recorriendo los likes -->
            @foreach($image->likes as $like)

            <!-- hacemos una ocndicion que si el usuario actual registrado con su id es igual que el id del que ha dado el like  -->
            <!-- la variable se pone a true  -->
            @if($like->user->id== Auth::user()->id)

            <?php $checklike = true?>
            @endif
            @endforeach

            <!-- comprobamos que si checklike es true entonces se pone el corazon rojo  -->
            @if($checklike)

            <img src="{{asset('img/heartred.png')}}" class="btn-dislike" data-id="{{$image->id}}" />

            <!-- si no se pone el corazon normal  -->
            @else
            <img src="{{asset('img/heartgray.png')}}" class="btn-like" data-id="{{$image->id}}" />

            @endif
            {{count($image->likes)}}
        </div>

    </div>

    <p>{{$image->description}}</p>
    <span>{{$image->created_at}}</span>



    <a href="" class="btn btn-sm btn-warning btn-coments">
        Comentarios ({{count($image->comments)}})

    </a>

</div>