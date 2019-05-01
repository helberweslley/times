<?php

namespace App\Http\Controllers;

use App\Jogo;
use App\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JogoController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jogo',['jogos' => Jogo::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jogo.adicionar', ['times' => Time::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'casa_id' => 'required',
            'visitante_id' => 'required',
        ]);

        $jogo = new Jogo([
            'casa_id' => $request->get('casa_id'),
            'visitante_id' => $request->get('visitante_id'),
        ]);

        $jogo ->save();

        return redirect('/jogo')->with('success', 'adicionado com sucesso');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function ConsultaAjax(Request $request)
    {

        $id = $request->get('id');

        $results = DB::select('SELECT t.id, t.name FROM times t WHERE  t.id not in (select j.visitante_id from jogos j where j.casa_id = ? UNION all select g.casa_id from jogos g where g.visitante_id = ?) and t.id <> ?', [3,3,3]);


        return response()->json(['response' => 'success', 'comments' => $results]);
    }
}
