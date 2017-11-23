
import { Component, OnInit ,Output,EventEmitter,Input} from '@angular/core';
import {HttpService} from "../http.service";
import {RequestOptions,Headers} from '@angular/http';
import { Observable } from 'rxjs/Observable';
@Component({
  selector: 'app-borrar-empleado',
  templateUrl: './borrar-empleado.component.html',
  styleUrls: ['./borrar-empleado.component.css']
})
export class BorrarEmpleadoComponent implements OnInit {
  @Input()
  id:any;
  listado:Array<any>;
  resultado:EventEmitter<any>;
  
  
  constructor(public mihttp:HttpService) { }

    ngOnInit() {
      this.resultado= new EventEmitter<any>();
      
     
    }
  
  Borrar()
  {
    console.log(this.id);
    var Empleado = {id:this.id};
    this.mihttp.httpDeletePromise('http://localhost:8080/apirestV6/empleado/',Empleado)
    .then(data =>{ 
      console.log(data);
      alert("Empleado Borrado");
      location.reload();
    })
    .catch(error =>
    {
      console.log(error);
    })

  }

}
