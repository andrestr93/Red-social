@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="profile-user">
                <div class="col-md-4">

                    @if($user->image)
                    <div class="container-avatar">


                        <img src="{{route('user.avatar' , ['filename' =>$user->image]) }}" class="avatar" />

                    </div>

                    @endif
                </div>
                <div class="user-info">

                    <h3>{{'@'.$user->nick}}</h3>


                </div>

                <!-- limpiamos el flotado -->
                <div class="clearfix"></div>
            </div>

            <hr />
            <!-- recorremos las imagenes del idd correspondiente al usuario  -->

        
    
            @foreach($user->images as $image)

            @include ('includes.image' , ['image =>$image'])

            @endforeach

      

        </div>
    </div>
</div>
@endsection