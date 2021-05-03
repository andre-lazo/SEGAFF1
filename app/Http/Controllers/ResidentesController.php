<?php

namespace App\Http\Controllers;
use App \ Models  \ personas;
use App \ Models  \ residentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResidentesController extends Controller
{ 
    var $file;

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
   
        $personas= new personas();
        $personas->nombre=$request->get('nombre');
        $personas->cedula=$request->get('cedula');
        $personas->estado_civil=$request->get('estado_civil');
        $personas->fecha_nacimiento=$request->get('fecha_nacimiento');
        $personas->edad=20;
        $personas->id_profesion=1;
        $personas->id_nacionalidad=163;
        $personas->sexo=$request->get('sexo');
        $personas->id_motivo=1;
        $personas->id_submotivo=2;
        $img_normal=$request->file('imagen_nombre');
  
      
        $tipoArchivo=        pathinfo($img_normal, PATHINFO_EXTENSION);
        $nombreArchivo=  pathinfo($img_normal, PATHINFO_FILENAME);
        $tamanoArchivo=    $img_normal->getSize();
        $imagenSubida=fopen(public_path() . '/img_carpeta/imagen.jpg','r');
        $binarioImagen=fread($imagenSubida,$tamanoArchivo);
       
        DB::table('persona')->insert(
            [
              'nombre'=>  $personas->nombre,
              'cedula'=>  $personas->cedula,
              'estado_civil'=>  $personas->estado_civil,
              'fecha_nacimiento'=>  $personas->fecha_nacimiento,
              'edad'=>  $personas->edad,
              'id_profesion'=>  $personas->id_profesion,
              'id_nacionalidad'=>  $personas->id_nacionalidad,
              'sexo'=>  $personas->sexo,
              'id_motivo'=>  $personas->id_motivo,
              'id_submotivo'=>  $personas->id_submotivo,
              'imagen'=>  $binarioImagen
                ]
        );

        $residentes= new residentes();
        $residentes->id_persona=DB::table('persona')->orderby('id_persona', 'desc')->first()->id_persona;
        $residentes->id_residencia=$request->get('residencia');
        $residentes->rubro="PROPIETARIO";
        $residentes->status="RESIDENTE";
        
            DB::table('residente')->insert(
                [
                  'id_persona'=>  $residentes->id_persona,
                  'id_residencia'=>  $residentes->id_residencia,
                  'rubro'=>  $residentes->rubro,
                  'status'=>  $residentes->status
                    ]
            );
       
        DB::table('tarea_programada_residente')->insert(
            [
               'id_residente'=> DB::table('residente')->orderby('id_residente', 'desc')->first()->id_residente,
               'estado'=> 0,
               'tipo_tarea'=> 'CREATE'
            ]
        );
        return redirect("/residente")->with('success','Registro exitoso'.$request->get('imagen_nombre'));
    }





    public function upload( Request $request)
    {
        
        $this->validate($request,[
            'file'=>'mimes:jpeg,jpg,bmp,png',
           
    ]);
    
        $file = $request->file('file');
        $path = public_path() . '/img_carpeta';
        $fileName = uniqid() . $file->getClientOriginalName();
    
        $file->move($path, 'imagen.jpg');
    
     
  
    
        return $path;
    }
}
