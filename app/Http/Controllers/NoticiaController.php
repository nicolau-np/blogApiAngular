<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Http\Resources\NoticiaResource;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticias = Noticia::paginate(14);

        return NoticiaResource::collection($noticias);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
             'titulo'=>'required|string',
         'descricao'=>'required|string',
         'img'=>'required|string',
        ], [], [
             'titulo'=>"Título",
         'descricao'=>"Descrição",
         'img'=>"Imagem",
        ]);

        $noticia = Noticia::create($request->all());
        return new NoticiaResource($noticia);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia = Noticia::find($id);
        if(!$noticia)
        return ['errors'=>['error'=>"Não encontrou notícia"]];

        return new NoticiaResource($noticia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $noticia = Noticia::find($id);
        if(!$noticia)
        return ['errors'=>['error'=>"Não encontrou notícia"]];

         $this->validate($request, [
             'titulo'=>'required|string',
         'descricao'=>'required|string',
         'img'=>'required|string',
        ], [], [
             'titulo'=>"Título",
         'descricao'=>"Descrição",
         'img'=>"Imagem",
        ]);

$noticia->update($request->all());
        return new NoticiaResource($noticia);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                 $noticia = Noticia::find($id);
        if(!$noticia)
        return ['data'=>['error'=>"Não encontrou notícia"]];

        $noticia->delete();

        return ['data'=>['success'=>"Eliminada com sucesso"]];
    }
}