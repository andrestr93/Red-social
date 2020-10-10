<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

use App\Image;

Route::get('/', function () {

    /*
      $images = Image::all();
      foreach($images as $image){
      echo $image->image_path."<br/>";
      echo $image->description."<br/>";
      echo $image->user->name.' '.$image->user->surname.'<br/>';

      if(count($image->comments) >= 1){
      echo '<h4>Comentarios</h4>';
      foreach($image->comments as $comment){
      echo $comment->user->name.' '.$comment->user->surname.': ';
      echo $comment->content.'<br/>';
      }
      }

      echo 'LIKES: '.count($image->likes);
      echo "<hr/>";
      }

      die();
     */
/*
    $images = Image::all();

    foreach ($images as $img) {

        // sacamos los siguientes registros 
        // sacamos decripcion de la imagen 
        echo '<br/>';
        echo '' . $img->description;
        echo '<br/>';
        // sacamos las imagenes relacionadas con sus usuarios
        echo $img->user->name . ' ---' . $img->user->surname . '---' . $img->image_path;



        // sacamos los likes que tiene cada foto
        echo ' <br/> LIKES :' . count($img->likes);
    }

    die();
 * 
 */
    return view('welcome');
});

// GENERALES
Auth::routes();
// RUTAS USUARIOS
Route::get('/', 'HomeController@index')->name('home');
Route::get('/config', 'usercontroller@config')->name('config');
Route::post('/user/update' , 'usercontroller@update') ->name('user.update');
Route::get('/perfil/{id}' , 'usercontroller@profile') ->name('profile');
Route::get('/user/avatar/{filename}' , 'usercontroller@getImage') ->name('user.avatar');
Route::get('/gente/{search?}', 'usercontroller@index')->name('user.index');

// RUTAS IMAGenes
Route::get('/subir-imagen' , 'ImagenController@create') ->name('image.create');
Route::post('/image/save' , 'ImagenController@save') ->name('image.save');
Route::get('/image/file/{filename}' , 'ImagenController@getImage') ->name('image.file');
Route::get('/image/{id}' , 'ImagenController@detail') ->name('image.detail');
Route::get('/image/delete/{id}', 'ImagenController@delete')->name('image.delete');
Route::get('/imagen/editar/{id}', 'ImagenController@edit')->name('image.edit');
Route::post('/image/update' , 'ImagenController@update') ->name('image.update');

//RUTAS COMENTARIOS
Route::post('/comment/save' , 'CommentController@save') ->name('comment.save');
Route::get('/comment/delete/{id}' , 'CommentController@delete') ->name('comment.delete');

//RUTAS LIKES
Route::get('/like/{image_id}' , 'LikeController@like') ->name('like.save');
Route::get('/dislike/{image_id}' , 'LikeController@dislike') ->name('like.delete');
Route::get('/likes' , 'LikeController@index') ->name('likes');





