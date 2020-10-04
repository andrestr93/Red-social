@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('includes.message')

            @foreach ($images as $image)

            <div class="card pub_image">

                <div class="card-reader">

                    @if($image->user->image)

                    <div class="container-avatar" >{{$image->user->nick}}
                        <img src="{{route('user.avatar' , ['filename' =>$image->user->image]) }}" class="avatar2" />


                    </div>


                    @endif

                </div>

                <div class="card-body">


                    <img src="{{ route('image.file' , ['filename' => $image->image_path]) }}"/>


                </div>
                
                <p>{{$image->description}}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
    @endsection
