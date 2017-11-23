import { window } from 'rxjs/operator/window';
import { Component, OnInit,Output,EventEmitter } from '@angular/core';
import {HttpService} from "../http.service";
import {RequestOptions,Headers} from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { Usuario } from '../usuario';
import {DirectivaDirective } from '../directiva.directive';

@Component({
  selector: 'app-inicio',
  templateUrl: './inicio.component.html',
  styleUrls: ['./inicio.component.css']
})

export class InicioComponent implements OnInit {
  resultado:Array<Object> = [];
  listado:Array<any>;
  editar:boolean;
  //token:any;
  
  id:number;
  nombre:string;
  tipo:string;
  edad:number;
  activo:boolean;
  elemento:any;
  inputNombre:string;
  inputPassword:string;
  //nombre:string;
  //password:string;
  logeado:boolean;
  mostrar;
  unUsuario:Usuario;
  pass:string;
  file;
  
    constructor(public mihttp:HttpService) {
     this.activo=false;
     this.tipo="Operario";  
     if(localStorage.getItem("token")==null)
     {
       console.log(localStorage.getItem("token"));
       this.logeado=false;
     }else{
       this.logeado=true;
     }
     }
     logearse()
     {
       this.unUsuario.nombreUsuario=this.inputNombre;
       this.unUsuario.password=this.inputPassword;
       this.unUsuario.tipo=this.tipo;
       
      if(localStorage.getItem("token")==null)
      {
        //var persona = ;
       this.mihttp.httpPostPromise('http://localhost:8080/apirestV6/ingreso/',{datosLogin: {
           usuario: this.unUsuario.nombreUsuario,
           clave: this.unUsuario.password ,
           tipo:this.unUsuario.tipo
       }} )
     .then( data => {
       console.info("data>>>",data);
       if ( data.token )
       {
         localStorage.setItem('token', data.token);
         this.logeado=true;
       }
      }).catch(error=>{alert("Datos incorrectos");});
     
     }
   
     }
  
    ngOnInit() {
      this.unUsuario = new Usuario('','','');
     // this.nombre="Marito";
      //this.password="f4a084904ed51be1a736f80b27ecefde808f9891";
      this.tipo="Operario";  
      this.mihttp.httpGetPromise('http://localhost:8080/apirestV6/empleado/')//CAMBIAR!!
      .then(data=>{
        this.listado=data;
        console.log(this.listado);
        
      })
      .catch(error=>{console.log(error);});
      
  
     //this.mihttp.http.post(('http://localhost:8080/apirestV6/login/'),).toPromise().then(this.token);
    }
    Guardar()
    {
      if(this.nombre!=null && this.tipo!=null && this.edad!=null)
      {
      this.mihttp.getJwt('http://localhost:8080/apirestV6/tomarToken')
    .then(data => {
      console.log(data);
      if(data!=null)
      {
        var nuevoEmpleado = {id:Math.random()*9999,nombre:this.nombre,password:this.pass,edad:this.edad,tipo:this.tipo};
        
            console.log(nuevoEmpleado);
        
             this.mihttp.httpPostPromise('http://localhost:8080/apirestV6/empleado/',nuevoEmpleado)
              .then( data=>{
                console.log(data);
                alert("Empleado Guardado");
                location.reload();
              })
              .catch(error=>{console.log(error);});
      }
    })
    .catch(e => {
      console.log(e);
    });
  }else{
    alert("Completa los campos requeridos");
  }
  }
   
  
  Check()
  {
    if(this.editar==true)
    {
      this.editar=false;
    }else
    {
      this.editar=true;
      
    }
  }
      
   MostrarP(sab)
    {
      
  
      for (var i = 0; i < this.listado.length; i++) {
       var element = this.listado[i];
        
        if(element.nombre===sab)
        {
          this.activo=true;
         return this.elemento=element;
        }
        
  
  
        }
        
      }
  
  
  
      /*showAlert(event)
      {
        console.log("xd");
        alert(event.result);
      }*/
    }
  
  
  
  
  
  