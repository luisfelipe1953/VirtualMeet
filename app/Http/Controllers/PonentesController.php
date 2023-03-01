<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePonentes;
use Illuminate\Http\Request;
use App\Models\Ponentes;
use App\Services\ServicePaginacion;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class PonentesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServicePaginacion $paginacion)
    {
        $pagina_actual = request('page', 1);

        $registros_por_pagina = 5;

        $total_registros = Ponentes::count();

        $paginacion = new ServicePaginacion($pagina_actual, $registros_por_pagina, $total_registros);

        $offset = $paginacion->offset();

        $ponentes = Ponentes::skip($offset)->take($registros_por_pagina)->get();



        return view('admin.ponente.index')->with([
            'ponentes' => $ponentes,
            'paginacion' => $paginacion
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ponentes = new Ponentes;

        return view('admin.ponente.create')->with([
            'ponente' => $ponentes,
            'redes' => (object) array_fill_keys(['github', 'tiktok', 'youtube', 'twitter', 'facebook', 'instagram'], ''),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePonentes $request)
    {
        $ponente = new Ponentes();
        $imagen = $request->file('imagen');

        if ($imagen) {
            $carpeta_imagenes = 'imagenes/speakers';
            // Crear la carpeta si no existe
            if (!Storage::exists($carpeta_imagenes)) {
                Storage::disk('public')->makeDirectory($carpeta_imagenes, 0755, true);
            }
            $nombre_imagen = md5(uniqid(rand(), true));
            $imagen_png = Image::make($imagen)->fit(800, 800)->encode('png', 80);
            $imagen_webp = Image::make($imagen)->fit(800, 800)->encode('webp', 80);
            // guardar las imagenes codificadas
            Storage::disk('public')->put($carpeta_imagenes . '/' . $nombre_imagen . '.png', (string)$imagen_png, 'public');
            Storage::disk('public')->put($carpeta_imagenes . '/' . $nombre_imagen . '.webp', (string)$imagen_webp, 'public');
            // guardar el nombre de la imagen en una variable para usarlo más tarde
            $ponente->imagen = $nombre_imagen;
        }

        // debuguear($_POST);

        $ponente->nombre = $request->get('nombre');
        $ponente->apellido = $request->get('apellido');
        $ponente->ciudad = $request->get('ciudad');
        $ponente->pais = $request->get('pais');
        $ponente->tags = $request->get('tags');
        $ponente->redes = json_encode($request->get('redes'), JSON_UNESCAPED_SLASHES);




        $ponente->save();
        return redirect('/ponentes')->with('success', 'Agregado Correctamente');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ponente = Ponentes::find($id);
        $ponente->imagenActual =  $ponente->imagen;


        return view('admin.ponente.edit')->with([
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePonentes $request, $id,)
    {
        $ponente = Ponentes::find($id);
        $imagenActual =  $ponente->imagen;
        $imagen = $request->file('imagen');

        if ($imagen) {
            $carpeta_imagenes = 'imagenes/speakers';
            // Crear la carpeta si no existe
            if (!Storage::exists($carpeta_imagenes)) {
                Storage::disk('public')->makeDirectory($carpeta_imagenes, 0755, true);
            }
            $nombre_imagen = md5(uniqid(rand(), true));
            $imagen_png = Image::make($imagen)->fit(800, 800)->encode('png', 80);
            $imagen_webp = Image::make($imagen)->fit(800, 800)->encode('webp', 80);

            // guardar las imagenes codificadas
            Storage::disk('public')->put($carpeta_imagenes . '/' . $nombre_imagen . '.png', (string)$imagen_png);
            Storage::disk('public')->put($carpeta_imagenes . '/' . $nombre_imagen . '.webp', (string)$imagen_webp);
            // guardar el nombre de la imagen en una variable para usarlo más tarde
            $ponente->imagen = $nombre_imagen;
        } else {
            $ponente->imagen = $imagenActual;
        }

        $ponente->nombre = $request->input('nombre');
        $ponente->apellido = $request->input('apellido');
        $ponente->ciudad = $request->input('ciudad');
        $ponente->pais = $request->input('pais');
        $ponente->tags = $request->input('tags');
        $ponente->redes = json_encode($request->input('redes'), JSON_UNESCAPED_SLASHES);

        $ponente->save();

        return redirect('/ponentes')->with('success', 'Editado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ponente = Ponentes::find($id);
        $ponente->delete();
        return redirect('/ponentes')->with('success', 'Eliminado Correctamente');
    }
}
