<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App\User;

class usercontroller extends Controller {
    
    // constructor que hace que no puedas ingresar a la ocnfiguracion sin estar identificado 
        public function __construct()
    {
        $this->middleware('auth');
    }

    public function config() {


        return view('user.config');
    }

    public function update(Request $request) {


        // cogemos el objeto de usuario y lo metemos en una variable
        $user = \Auth::user();
        // cogemos el id de ese usuario
        $id = \Auth::user()->id;

        //Validacion del formulario 

        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id
        ]);

        // Recoger los datos dle formulario 

        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');


        // subir la imagen 

        $image_path = $request->file('image_path');
        
        if($image_path){
            
            // poner nombre unico 
            $imagencomplete= time().$image_path->getClientOriginalName();
            
            //guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($imagencomplete , File::get($image_path));
            
            // seteo la variable imagen del objeto 
            $user->image = $imagencomplete;
            
        }
        
        



        //asignar los valores al objeto del usuario 

        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        // ejecutar consulta y actualizar cambios 
        $user->update();
        // redireccionamos 

        return redirect()->route('config')
                        ->with(['message' => 'Usuario actualizado correctamente']);
    }
    
    public function getImage($filename){
        
        // cogemos la imagen del discovirtual 

        
        $file = Storage::disk('users')->get($filename);
        
        // y retornamos el response con error de 200 
        return new Response($file , 200);
        
    }

    public function profile($id){

        $user = User::find($id);

        return view ('user.profile' , [
            'user' =>$user
        ]);
    }

}
