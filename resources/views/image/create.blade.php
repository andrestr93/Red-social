@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header"> Subir nueva Imagen</div>


                <div class="card-body">

                    <form method="POST" action="{{route('image.save')}}" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group row">

                            <label for="imagen_path" class="col-md-3 col-form-label text-md-right">Imagen</label>

                            <div class="col-md-6">

                                <input id="image_path" type="file" name="image_path" class="form-control" required>

                                @if($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image_path') }}</strong>
                                </span>
                                @endif        

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-7">
                                <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" required></textarea>

                                @if($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input  class="btn btn-primary"type="submit" value="guardar"/>
                            </div>
                        </div>
                    
                </form>

            </div>
        </div>


        </form>
    </div>

</div>
</div>

@endsection