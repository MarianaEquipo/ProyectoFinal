<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modelo;

class PrincipalController extends Controller
{
    public function index(){
        $objetos=Modelo::paginate(3);
        return view('index', compact('objetos'));
    }

    public function agregar(){
        return view('/agregar');
    }

public function guardar(Request $request, Modelo $objeto)
{
    $request->validate([
        'titulo' => 'required',
        'autor' => 'required',
        'fecha' => 'required',
        'gusto' => 'required',
        'genero' => 'required',
        'sinopsis' => 'required',
        'duracion' => 'required',
        'portada' => 'required|image',
        'video' => 'required|mimes:mp4,avi,mkv|max:20000', 
          'tipo' => 'required'
    ], [
        'titulo.required' => 'El título es obligatorio',
        'autor.required' => 'El autor es obligatorio',
        'fecha.required' => 'La fecha es obligatoria',
        'gusto.required' => 'Indica si la película te gustó o no',
        'genero.required' => 'El género es obligatorio',
        'sinopsis.required' => 'La sinopsis es obligatoria',
        'duracion.required' => 'La duración es obligatoria',
        'portada.required' => 'La portada es obligatoria',
        'portada.image' => 'La portada debe ser una imagen',
        'video.required' => 'El video es obligatorio',
        'video.mimes' => 'El video debe ser un archivo con formato mp4, avi o mkv',
        'video.max' => 'El tamaño del video no debe superar 20 MB',
        'tipo.required'=>'El tipo es obligatorio'
    ]);

    $portada = time() . '.' . $request->portada->extension();
    $request->portada->move(public_path('imagenes'), $portada);

    $video = time() . '.' . $request->video->extension();
    $request->video->move(public_path('videos'), $video);

    $objeto = Modelo::create([
        'titulo' => $request->titulo,
        'autor' => $request->autor,
        'genero' => $request->genero,
        'sinopsis' => $request->sinopsis,
        'duracion' => $request->duracion,
        'fecha' => $request->fecha,
        'gusto' => $request->gusto,
        'portada' => $portada,
        'video' => $video,
        'tipo'=>$request->tipo
    ]);

    return redirect()->route('index')->with('mensaje', 'Agregado Correctamente');
}

    public function borrar($objeto){
        $ob=Modelo::find($objeto);
        $ob->delete();
        return redirect()->route('index')->with('mensaje','Eliminado Correctamente');
    }

    public function editar(Modelo $objeto){
        return view('editar', compact('objeto'));
    }

    public function actualizar(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required',
        'autor' => 'required',
        'fecha' => 'required',
        'gusto' => 'required',
        'genero' => 'required',
        'sinopsis' => 'required',
        'duracion' => 'required',
        'portada' => 'nullable|image', 
        'video' => 'nullable|file|mimes:mp4,avi,mkv', 
        'tipo' => 'required'
    ]);

    $objeto = Modelo::find($id);

    if ($request->hasFile('portada')) {
        if ($objeto->portada && file_exists(public_path('imagenes/' . $objeto->portada))) {
            unlink(public_path('imagenes/' . $objeto->portada));
        }
        $portada = time() . '.' . $request->portada->extension();
        $request->portada->move(public_path('imagenes'), $portada);
        $objeto->portada = $portada;
    }

    if ($request->hasFile('video')) {
        if ($objeto->video && file_exists(public_path('videos/' . $objeto->video))) {
            unlink(public_path('videos/' . $objeto->video));
        }
        $video = time() . '.' . $request->video->extension();
        $request->video->move(public_path('videos'), $video);
        $objeto->video = $video;
    }

    $objeto->titulo = $request->titulo;
    $objeto->autor = $request->autor;
    $objeto->fecha = $request->fecha;
    $objeto->genero = $request->genero;
    $objeto->sinopsis = $request->sinopsis;
    $objeto->duracion = $request->duracion;
    $objeto->gusto = $request->gusto;
    $objeto->tipo=$request->tipo;

    $objeto->save();

    return redirect()->route('index')->with('mensaje', 'Actualización exitosa');
}


    public function ordenar($tipo){
        $objetos=[];
        switch($tipo){
            case 'tituloa':$objetos=Modelo::orderby('titulo','asc')->paginate(3);
            break;

            case 'titulod':$objetos=Modelo::orderby('titulo','desc')->paginate(3);
            break;

            case 'autora':$objetos=Modelo::orderby('autor','asc')->paginate(3);
            break;

            case 'autord':$objetos=Modelo::orderby('autor','desc')->paginate(3);
            break;

            case 'duraciona':$objetos=Modelo::orderby('duracion','asc')->paginate(3);
            break;

            case 'duraciond':$objetos=Modelo::orderby('duracion','desc')->paginate(3);
            break;

            case 'sinopsisa':$objetos=Modelo::orderby('sinopsis','desc')->paginate(3);
            break;

            case 'sinopsisa':$objetos=Modelo::orderby('sinopsis','desc')->paginate(3);
            break;

            case 'categoriaa':$objetos=Modelo::orderby('categoria','asc')->paginate(3);
            break;
            
            case 'categoriad':$objetos=Modelo::orderby('categoria','asc')->paginate(3);
            break;
        }

        return view('index',compact('objetos'));
    }

    public function buscar(Request $request){
        $buscar=$request->input('buscar');
                $objetos=Modelo::query();
        if($buscar){
            $objetos->where(function($b) use ($buscar){
                $b->where('titulo','LIKE','%'.$buscar.'%')
                ->orWhere('autor','LIKE','%'.$buscar.'%')
                ->orWhere('genero','LIKE','%'.$buscar.'%')
                ->orWhere('sinopsis','LIKE','%'.$buscar.'%')
                ->orWhere('duracion','LIKE','%'.$buscar.'%')
                ->orWhere('gusto','LIKE','%'.$buscar.'%')
                ->orWhere('fecha','LIKE','%'.$buscar.'%');       
            });
        }
        $objetos=$objetos->paginate(3);
        return view('index',compact('objetos'));
    }

}
