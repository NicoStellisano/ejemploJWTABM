import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import {HttpModule} from '@angular/http';
import { HttpService } from './http.service';
import { InicioComponent } from './inicio/inicio.component';
import { FormsModule } from '@angular/forms';
import { BorrarEmpleadoComponent } from './borrar-empleado/borrar-empleado.component';
import { DirectivaDirective } from './directiva.directive';

@NgModule({
  declarations: [
    AppComponent,
    InicioComponent,
    BorrarEmpleadoComponent,
    DirectivaDirective
  ],
  imports: [
    BrowserModule,
    HttpModule,
    FormsModule,
  ],
  providers: [HttpService],
  bootstrap: [AppComponent]
})
export class AppModule { }
