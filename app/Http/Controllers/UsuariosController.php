<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use App\Http\Requests\UsuarioFormRequest;
use Auth;
use Image;



class UsuariosController extends Controller
{

public function form_nuevo_usuario(){
    //carga el formulario para agregar un nuevo usuario
    $roles=Role::all();
    return view("formularios.form_nuevo_usuario")->with("roles",$roles);

}


public function form_nuevo_rol(){
    //carga el formulario para agregar un nuevo rol
    $roles=Role::all();
    return view("formularios.form_nuevo_rol")->with("roles",$roles);
}

public function form_nuevo_permiso(){
    //carga el formulario para agregar un nuevo permiso
     $roles=Role::all();
     $permisos=Permission::all();
    return view("formularios.form_nuevo_permiso")->with("roles",$roles)->with("permisos", $permisos);
}



public function listado_usuarios(){
	$usuarios=User::paginate(7);
	return view("listados.listado_usuarios")->with("usuarios",$usuarios);
}


public function crear_usuario(UsuarioFormRequest $request){

	$usuario=new User;
	$usuario->nombres=strtoupper( $request->input("nombres") ) ;
    $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
	$usuario->telefono=$request->input("telefono");
	$usuario->email=$request->input("email");
    $usuario->password= bcrypt( $request->input("password") );


    if($usuario->save())
    {

      return view("mensajes.msj_usuario_creado")->with("msj","Usuario agregado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }

}


public function crear_rol(Request $request){

   $rol=new Role;
   $rol->name=$request->input("rol_nombre") ;
   $rol->slug=$request->input("rol_slug") ;
   $rol->description=$request->input("rol_descripcion") ;
    if($rol->save())
    {
        return view("mensajes.msj_rol_creado")->with("msj","Rol agregado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }
}


public function crear_permiso(Request $request){

  
   $permiso=new Permission;
   $permiso->name=$request->input("permiso_nombre") ;
   $permiso->slug=$request->input("permiso_slug") ;
   $permiso->description=$request->input("permiso_descripcion") ;
    if($permiso->save())
    {
        return view("mensajes.msj_permiso_creado")->with("msj","Permiso creado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }


}

public function asignar_permiso(Request $request){

     $roleid=$request->input("rol_sel");
     $idper=$request->input("permiso_rol");
     $rol=Role::find($roleid);
     $rol->assignPermission($idper);
    
    if($rol->save())
    {
        return view("mensajes.msj_permiso_creado")->with("msj","Permiso asignado correctamente") ;
    }
    else
    {
        return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ;...") ;
    }
}


    public function form_editar_usuario($id){
        $usuario=User::find($id);
        $roles=Role::all();
        return view("formularios.form_editar_usuario")->with("usuario",$usuario)
            ->with("roles",$roles);
    }

    public function editar_usuario(Request $request){

        $idusuario=$request->input("id_usuario");
        $usuario=User::find($idusuario);
        $usuario->nombres=strtoupper( $request->input("nombres") ) ;
        $usuario->apellidos=strtoupper( $request->input("apellidos") ) ;
        $usuario->telefono=$request->input("telefono");


        if($request->has("rol")){
            $rol=$request->input("rol");
            $usuario->revokeAllRoles();
            $usuario->assignRole($rol);
        }

        if( $usuario->save()){
            return view("mensajes.msj_usuario_actualizado")->with("msj","Usuario actualizado correctamente")
                ->with("idusuario",$idusuario) ;
        }
        else
        {
            return view("mensajes.mensaje_error")->with("msj","..Hubo un error al agregar ; intentarlo nuevamente..");
        }
    }


    public function buscar_usuario(Request $request){
	$dato=$request->input("dato_buscado");
	$usuarios=User::where("nombres","like","%".$dato."%")
        ->orwhere("apellidos","like","%".$dato."%")
        ->paginate(100);
	return view('listados.listado_usuarios')->with("usuarios",$usuarios);
      }



    public function borrar_usuario(Request $request){


        $idusuario=$request->input("id_usuario");
        $usuario=User::find($idusuario);

        if($usuario->delete()){
            return view("mensajes.msj_usuario_borrado")->with("msj","Usuario borrado correctamente") ;
        }
        else
        {
            return view("mensajes.mensaje_error")->with("msj","..Hubo un error al agregar ; intentarlo nuevamente..");
        }

    }

    public function editar_acceso(Request $request){
        $idusuario=$request->input("id_usuario");
        $usuario=User::find($idusuario);
        $usuario->email=$request->input("email");
        $usuario->password= bcrypt( $request->input("password") );

        if( $usuario->save()){
            return view("mensajes.msj_usuario_actualizado")->with("msj","Usuario actualizado correctamente")->with("idusuario",$idusuario) ;
        }
        else
        {
            return view("mensajes.mensaje_error")->with("msj","...Hubo un error al agregar ; intentarlo nuevamente ...") ;
        }
    }




    public function asignar_rol($idusu,$idrol){

        $usuario=User::find($idusu);
        $usuario->assignRole($idrol);
        $usuario=User::find($idusu);
        $rolesasignados=$usuario->getRoles();
        return json_encode ($rolesasignados);

}

public function quitar_rol($idusu,$idrol){

    $usuario=User::find($idusu);
    $usuario->revokeRole($idrol);
    $rolesasignados=$usuario->getRoles();
    return json_encode ($rolesasignados);

}

public function form_borrado_usuario($id){
  $usuario=User::find($id);
  return view("confirmaciones.form_borrado_usuario")->with("usuario",$usuario);

}

public function quitar_permiso($idrole,$idper){ 
    
    $role = Role::find($idrole);
    $role->revokePermission($idper);
    $role->save();

    return "ok";
}


public function borrar_rol($idrole){

    $role = Role::find($idrole);
    $role->delete();
    return "ok";
}

public function profile(){
    return view('profile',array('users'=>Auth::user()));
}

public function update_avatar(Request $request){

    if($request->hasFile('avatar')){
        $avatar =$request->file('avatar');
        $filename =time(). '.'. $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300,300)->save(public_path('img/avatars/'.$filename));

        $user= Auth::user();
        $user->avatar=$filename;
        $user->save();

        return view('profile',array('users'=>Auth::user()));
    }


}

}
