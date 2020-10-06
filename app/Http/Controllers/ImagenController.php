<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller {

    // constructor que permite que no subamos imagen sin estar identificado
    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function create() {

        return view( 'image.create' );
    }

// metodo para guardar la foto

    public function save( Request $request ) {

        //Validación
        $validate = $this->validate( $request, [
            'description' => 'required',
            'image_path'  => 'required|image',
        ] );

        // Recoger datos
        $image_path = $request->file( 'image_path' );
        $description = $request->input( 'description' );

        // Asignar valores al nuevo objeto
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        // Subir fichero
        if ( $image_path ) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk( 'images' )->put( $image_path_name, File::get( $image_path ) );
            $image->image_path = $image_path_name;
        }

        $image->save();
//redireccionamos e incluimos un mensaje como que se ha subido correctamente la foto
        return redirect()->route( 'home' )->with( [
            'message' => 'La foto ha sido subida correctamente!!',
        ] );
    }

    // funcion que nos permite recoger las imagenes
    public function getImage( $filename ) {

        $file = Storage::disk( 'images' )->get( $filename );

        return new Response( $file, 200 );
    }

    // funcion que te permite abrir la imagen al detalle

    public function detail( $id ) {

        $image = Image::find( $id );

        return view( 'image.detail', [

            'image' => $image,

        ] );

    }

}
