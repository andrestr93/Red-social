<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller {

    // constructor que permite que no subamos imagen sin estar identificado
    public function __construct() {
        $this->middleware( 'auth' );
    }


    // funcion para agregar comentarios en las imagenes y guardarlos en la base de datos
    public function save( Request $request ) {

        //Validación
        $validate = $this->validate( $request, [
            'image_id' => 'integer|required',
            'content'  => 'string|required',
        ] );
        // Recoger los datos

        

        $user = \Auth::user();
        $image_id = $request->input( 'image_id' );
        $contect = $request->input( 'content' );
        // Asigno valores a mi nuevo objeto
        $commment = new Comment();
        $commment->user_id = $user->id;
        $commment->image_id = $image_id;
        $commment->content = $contect;

        // guardamos en la base de datos
        $commment->save();

     

        // Retornamos
        return redirect()->route( 'image.detail', ['id' => $image_id] )
            ->with(
                ['message' => 'has publicado tu mensaje correctamente',
                ] );

    }

    public function delete( $id ) {

        // conseguir datos del usuario identificado

        // conseguimos los datos del usuario actual
        $user = \Auth::user();

        // conseguir el objeto del comentario

        $comment = Comment::find( $id ); // le pasamos el id con el metodo find

        // Compruebo si soy el dueño del comentario o de la publicacion

        if ( $user && ( $comment->user_id == $user->id || $comment->image->user_id == $user->id ) ) {
            // esta condicion sifnifica lo siguiente , si el usuario esta identificado si el comentario creado pertenece al mismo usuario
            //o si el que ha creado la imagen tiene el mismo id que el usuario identificado

            // borramos el comentario

            $comment->delete();

            // redireccionamos
            return redirect()->route( 'image.detail', ['id' => $comment->image->id] )
                ->with(
                    ['message' => 'Comentario eliminado correctamente',
                    ] );

        } else {

            return redirect()->route( 'image.detail', ['id' => $comment->image->id] )
                ->with(
                    ['message' => 'Fallo al borrar el comentario',
                    ] );

        }

    }

}