<?php
class Empleado
{
	public $id;
 	public $nombre;
  	public $tipo;
    public $edad;
  	public $foto;


  	public function BorrarEmpleado()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM empleados 				
				WHERE id='$this->id'");	
				$consulta->execute();
				return $consulta->rowCount();
	 }

	
	public function ModificarEmpleado()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE empleados 
				SET edad='$this->edad',
                nombre=$this->nombre,
				password=$this->password,
                tipo=$this->tipo        				
				WHERE id='$this->id'");
			return $consulta->execute();

	 }
	
  
	 public function InsertarEmpleado()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleados (id,nombre,password,tipo,edad)values('$this->id','$this->nombre','$this->password','$this->tipo','$this->edad'");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();			
	 }

	 public static function esValido($usuario, $clave,$tipo) {
		$user=Empleado::TraerUnaEmpleado($usuario);
  
		 if($usuario==$user->nombre && $clave==$user->password && $tipo==$user->tipo)
		 {
		   return true;
		 }
		 else
		 {
			return false;
  
		 }
		
	  }

	/* public static function Login($nombre,$password)
	 {
		 $user=Empleado::TraerUnaPersona($nombre);
		 if($user->password == $password && $user!=NULL)
		 {
			 
			 $datos = array('nombre' => $user->nombre,'sexo' => $user->sexo, 'mail' => $user->mail);
			 
			 $token= AutentificadorJWT::CrearToken($datos);
			 echo $token;
 
		 }
 
	 }

	 public static function TraerUnaPersona($nombre) 
	 {
			 $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			 $consulta =$objetoAccesoDato->RetornarConsulta("SELECT nombre,mail,sexo,password FROM empleados WHERE nombre = '$nombre'");
			 $consulta->execute();
			 $cdBuscado= $consulta->fetch(PDO::FETCH_ASSOC);
			 $aux= new stdclass();
			 $aux->nombre=$cdBuscado['nombre'];
			 $aux->mail=$cdBuscado['mail'];
			 $aux->sexo=$cdBuscado['sexo'];
			 $aux->password=$cdBuscado['password'];
			 return $aux;				
 
			 
	 }*/


  	public static function TraerEmpleados()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, nombre,password, tipo , edad,foto FROM empleados");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Empleado");		
	}

	public static function TraerUnaEmpleado($usuario) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id,nombre,password,tipo,edad,foto FROM empleados WHERE nombre = '$usuario'");
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('Empleado');
			return $cdBuscado;				

			
	}

	

	public function mostrarDatos()
	{
	  	return "Metodo mostrar:".$this->id."  ".$this->nombre."  ".$this->tipo."  ".$this->edad;
	}

}