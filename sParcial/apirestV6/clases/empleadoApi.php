<?php
require_once 'Empleado.php';
require_once 'IApiUsable.php';

class EmpleadoApi extends Empleado implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['nombre'];
        $elEmpleado=Empleado::TraerUnaEmpleado($nombre);
        if(!$elEmpleado)
        {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->error="No esta El Empleado";
            $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
        }else
        {
            $NuevaRespuesta = $response->withJson($elEmpleado, 200); 
        }     
        return $NuevaRespuesta;
    }
     public function TraerTodos($request, $response, $args) {
      	$todosLosEmpleados=Empleado::TraerEmpleados();
     	$newresponse = $response->withJson($todosLosEmpleados, 200);  
    	return $newresponse;
    }
      public function CargarUno($request, $response, $args) {
     	
        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $id= $ArrayDeParametros['id'];
        $nombre= $ArrayDeParametros['nombre'];
        $tipo= $ArrayDeParametros['tipo'];
        $tipo= $ArrayDeParametros['password'];
        
        $edad=($ArrayDeParametros['edad']);

        
        $micd = new Empleado();
        $micd->id=$id;
        $micd->nombre=$nombre;
        $micd->tipo=$tipo;
        $micd->password=$password;
        
        $micd->edad=($edad);
       
        
       // $archivos = $request->getUploadedFiles();
        //  $destino="./clases/fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);
       /* if(isset($archivos['foto']))
        {
            $idAnterior=$archivos['foto']->getClientFilename();
            $extension= explode(".", $idAnterior)  ;
            //var_dump($idAnterior);
            $extension=array_reverse($extension);
            $archivos['foto']->moveTo($destino.$id.".".$extension[0]);
            
            $micd->foto=$id.".".$extension[0];
        }else{*/

            $micd->foto="https://thumbs.dreamstime.com/z/pulgar-del-avatar-del-valor-por-defecto-6599242.jpg";
           
        $micd->InsertarEmpleado(); 
        //$response->getBody()->write("se guardo el cd");
        $objDelaRespuesta->respuesta="Se guardo el Empleado.";   
        return $response->withJson($objDelaRespuesta, 200);
    }
      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id'];
     	$Empleado= new Empleado();
     	$Empleado->id=$id;
     	$cantidadDeBorrados=$Empleado->BorrarEmpleado();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	    if($cantidadDeBorrados>0)
	    	{
	    		 $objDelaRespuesta->resultado="algo borro!!!";
	    	}
	    	else
	    	{
	    		$objDelaRespuesta->resultado="no Borro nada!!!";
	    	}
	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
      	return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
     	//$response->getBody()->write("<h1>Modificar  uno</h1>");
     	$ArrayDeParametros = $request->getParsedBody();
	    //var_dump($ArrayDeParametros);    	
	    $micd = new Empleado();
	    $micd->id=$ArrayDeParametros['Empleado'];
        $micd->edad=$ArrayDeParametros['edad'];
        $micd->password=$ArrayDeParametros['password'];
        
	    $micd->nombre=$ArrayDeParametros['nombre'];
        $micd->tipo=$ArrayDeParametros['tipo'];
	 
	   	$resultado =$micd->ModificarEmpleado();
	   	$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
        $objDelaRespuesta->tarea="modificar";
		return $response->withJson($objDelaRespuesta, 200);		
    }

    /*public function Logearse($request, $response, $args)
    {
         $ArrayDeParametros = $request->getParsedBody();
            //var_dump($ArrayDeParametros);
           // $nombre= $ArrayDeParametros['nombre'];
            //$password= $ArrayDeParametros['password'];
            $obj=$ArrayDeParametros['persona'];
          //  $resultado=Empleado::Login($nombre,$password);
          $resultado=Empleado::Login($obj->nombre,$obj->password);
            $objDelaRespuesta->resultado=$resultado;
            //$password= sha1($ArrayDeParametros['password']);
          return  $response->withJson($objDelaRespuesta,200);
    }*/


}