import { Directive, ElementRef, OnInit, Renderer2, Input } from '@angular/core';

@Directive({
  selector: '[appColor]'
})
export class DirectivaDirective implements OnInit {

  @Input() appColor: string;
  mensaje:string;

  ngOnInit(): void {
    console.log(this.el);
    if ( !this.appColor ) {
      this.appColor = 'green';
      this.mensaje='';
    }
    // this.renderer.setProperty(this.el.nativeElement, 'textContent', '');
    this.renderer.setStyle(this.el.nativeElement, 'backgroundColor', this.appColor);
    this.renderer.setStyle(this.el.nativeElement, 'font-family', "Georgia");
    

    // this.el.nativeElement.style.backgroundColor = this.appColor;
  }

  constructor(private el: ElementRef, private renderer: Renderer2) { }



}
