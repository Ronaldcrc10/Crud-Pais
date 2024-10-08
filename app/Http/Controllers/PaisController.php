<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$paises = Pais::all();

        $paises = DB::table('tb_pais')
        ->join('tb_departamento', 'tb_pais.pais_codi', '=', 'tb_departamento.pais_codi')
        ->select('tb_pais.*', 'tb_departamento.depa_nomb')
        ->get();

        return view('pais.index', ['paises' => $paises]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos= DB::table('tb_departamento')
        ->orderBy('depa_nomb')
        ->get();
        return view('pais.new', ['departamentos' =>$departamentos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pais= new Pais();

        $pais->pais_nomb = $request->name;
        $pais->depa_capi = $request->code;
        //$pais->save(); me genera error i dont why :(

        $paises = DB::table('tb_pais')
        ->join('tb_departamento', 'tb_pais.pais_codi', '=', 'tb_departamento.pais_codi')
        ->select('tb_pais.*', 'tb_departamento.depa_nomb')
        ->get();
        return view('pais.index', ['paises' => $paises]);
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
        $pais = Pais::find($id);
        $departamentos = DB::table('tb_departamento')
        ->orderBy('depa_nomb')
        ->get();
        
        return view('pais.edit', ['pais' => $pais,'departamentos' => $departamentos]);
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
        $pais = Pais::find($id);

        $pais->pais_nomb = $request->name;
        $pais->depa_capi = $request->code;
        $pais->save();

        $paises = DB::table('tb_pais')
        ->join('tb_departamento', 'tb_pais.pais_codi', '=', 'tb_departamento.pais_codi')
        ->select('tb_pais.*', 'tb_departamento.depa_nomb')
        ->get();
        return view('pais.index', ['paises' => $paises]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pais = Pais::find($id);
        $pais->delete();

        $paises = DB::table('tb_pais')
        ->join('tb_departamento', 'tb_pais.pais_codi', '=', 'tb_departamento.pais_codi')
        ->select('tb_pais.*', 'tb_departamento.depa_nomb')
        ->get();
        return view('pais.index', ['paises' => $paises]);

    }
}
