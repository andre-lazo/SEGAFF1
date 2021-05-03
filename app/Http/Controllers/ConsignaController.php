<?php

namespace App\Http\Controllers;
use App\Models\CONSIGNA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ConsignaController extends Controller
{
    public function index(){
        $consignas=DB::table('consignas')
        ->join('residencia','consignas.id_residencia','residencia.id_residencia')
        ->orderby('id_consigna', 'desc')->paginate(5);
        $residentes=DB::table('residente')
        ->join('persona','residente.id_persona','persona.id_persona')
       ->paginate(5);
        $residencias=DB::table('residencia')->get();
        return view("Administracion.index",['consignas'=>$consignas,
        'residencias'=>$residencias,'residentes'=>$residentes]);

    }
    public function store(Request $request){
        $this->validate($request,[
                'fecha_inicio'=>'required',
                'fecha_fin'=>'required|after_or_equal:fecha_inicio',
                'descripcion'=>'required',
        ]);
        $consignas= new CONSIGNA();
        $consignas->fecha_creacion=\Carbon\Carbon::now();
        $consignas->titulo=$request->get('titulo');
        $consignas->descripcion=$request->get('descripcion');
        $consignas->fecha_inicio=$request->get('fecha_inicio');
        $consignas->fecha_fin=$request->get('fecha_fin');
        $consignas->id_residencia=$request->get('residencia');
        $consignas->id_residente=79;
        $consignas->id_guardia=2;
        $consignas->estado_consigna='PENDIENTE';
        $consignas->consigna_categoria='GUARDIA';
        $consignas->consigna_subcategoria='GUARDIA';
            DB::table('consignas')->insert(
                [
                    'titulo'=> $consignas->titulo,
                   'fecha_creacion'=> $consignas->fecha_creacion,
                   'descripcion'=> $consignas->descripcion,
                   'fecha_inicio'=> $consignas->fecha_inicio,
                   'fecha_fin'=> $consignas->fecha_fin,
                   'id_residencia'=> $consignas->id_residencia,
                   'id_residente'=> $consignas->id_residente,
                   'id_guardia'=> $consignas->id_guardia,
                   'estado_consigna'=> $consignas->estado_consigna,
                   'consigna_categoria'=> $consignas->consigna_categoria,
                   'consigna_subcategoria'=> $consignas->consigna_subcategoria]
            );
       
        DB::table('tarea_programada_consignas')->insert(
            [
               'id_consigna'=> DB::table('consignas')->orderby('id_consigna', 'desc')->first()->id_consigna,
               'estado'=> 0,
               'tipo_tarea'=> 'CREATE'
            ]
        );
        return redirect("/consigna")->with('success','Registro exitoso');
    }
    public function show()
    {
    }

   
    public function update(Request $request)
    {
        $this->validate($request,[
            'fecha_inicio'=>'required',
            'fecha_fin'=>'required|after_or_equal:fecha_inicio',
            'descripcion'=>'required',
    ]);
    
     $consigna=DB::table('consignas')->where('id_consigna', $request->get('id'))->first();
     $consigna->titulo=$request->get('titulo');
      $consigna->descripcion=$request->get('descripcion');
        $consigna->fecha_inicio=$request->get('fecha_inicio');
        $consigna->fecha_fin=$request->get('fecha_fin');
        $consigna->id_residencia=$request->get('residencia');
        $consigna->id_residente=79;
        DB::table('consignas')->where('id_consigna', $consigna->id_consigna
        )->update(
            [ 'titulo'=> $consigna->titulo,
               'descripcion'=> $consigna->descripcion,
               'fecha_inicio'=> $consigna->fecha_inicio,
               'fecha_fin'=> $consigna->fecha_fin,
               'id_residencia'=> $consigna->id_residencia,
               'id_residente'=> $consigna->id_residente
              ]
        );
   
        DB::table('tarea_programada_consignas')->insert(
            [
               'id_consigna'=> $consigna->id_consigna,
               'estado'=> 0,
               'tipo_tarea'=> 'UPDATE'
            ]
        );
      
      return redirect('/consigna')->with('success','Edicion exitosa');;
    }

   
}
