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
        return view('relationship.index',['relationships' => Relationship::paginate(10)]);
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
        $data2 = [];
        $relationship = Relationship::all();
        foreach ($relationship as $relationship)
        {
            $data2[] = [
                'source' => $relationship->source->name,
                'target' => $relationship->target->name,
                'type' => "licensing",
                'description_s' => $relationship->source->description,
                'app_ip_s' => $relationship->source->app_ip,
                'app_user_s' => $relationship->source->app_user,
                'app_pass_s' =>$relationship->source->app_pass,
                'description_t' => $relationship->target->description,
                'app_ip_t' => $relationship->target->app_ip,
                'app_user_t' => $relationship->target->app_user,
                'app_pass_t' =>$relationship->target->app_pass
            ];
        }
/*
        $id = $request->get('id');

        $results = DB::select('select (select s.name from sistemas s where s.id = r.source_id), (select s.name from sistemas s where s.id = r.target_id) from relationships r');

        //return response()->json(['response' => 'success', 'comments' => $results]);*/
        return $data2;
    }
}
