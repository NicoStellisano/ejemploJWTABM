export class Usuario {
    public nombreUsuario: string = '';
    public password: string = '';
    public tipo :string =''
  
    constructor( nombreUsuario: string, password: string,tipo :string)
    {
      this.nombreUsuario = nombreUsuario;
      this.password = password;
      this.tipo = tipo;
      
    }
  }