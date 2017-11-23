import { Injectable } from '@angular/core';
import {Http,Response,RequestOptions} from '@angular/http';
import 'rxjs/add/operator/toPromise';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';
@Injectable()
export class HttpService {

  constructor(public http:Http) { }

  public httpGetPromise(url:string,objeto?:any)
  {
    return this.http
    .get(url)
    .toPromise()
    .then(this.extraerDatos)
    .catch(this.handleError);
  }

  getJwt(url)
  {
    return this.http.get(url)
    .toPromise()
    .then( this.extraerDatos )
    .catch( this.handleError );
  }
  public httpPostPromise(url:string,objeto?:any)
  {   
     return this.http.post(url,objeto)
     .toPromise()
     .then(this.extraerDatos)
     .catch(this.handleError);
  }

  private extraerDatos(resp:Response)
  {
    return resp.json() || {};
  }

  private handleError(error:Response | any)
  {
    return error;
  }

  public httpDeletePromise(url:string,object:any)
  {
    
    return this.http
    .delete(url, new RequestOptions({
      body:object
    }))
    .toPromise()
    .then( this.extraerDatos)
    .catch(error => console.log(error));
  }
}
