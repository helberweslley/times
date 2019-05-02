<?php

namespace App\Http\Controllers;

use App\Relationship;
use App\Sistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelationshipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('relationship.index',['relationships' => Relationship::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('relationship.adicionar', ['sistemas' => Sistema::all()]);
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
            'source_id' => 'required',
            'target_id' => 'required',
        ]);

        $relationship = new Relationship([
            'source_id' => $request->get('source_id'),
            'target_id' => $request->get('target_id'),
        ]);

        $relationship ->save();

        return redirect('/relationship')->with('success', 'Adicionado com sucesso');
    }

    public function retornoAjax(Request $request)
    {

        $results = DB::select('select (select s.name from sistemas s where s.id = r.source_id), (select s.name from sistemas s where s.id = r.target_id) from relationships r');

        dump($results);
        return response()->json(['response' => 'success', 'comments' => $results]);

   /*     $data2 = [];
        $relationship = Relationship::all();
        foreach ($relationship as $relationship)
        {
            $data2[] = [
                'source' => $relationship->source->name,
                'target' => $relationship->target->name,
                'type' => "licensing"
            ];
        }
        return $data2;*/
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
