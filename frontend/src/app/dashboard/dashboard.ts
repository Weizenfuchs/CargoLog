import { Component } from '@angular/core';
import { CargoEditor } from '../cargo/cargo-editor/cargo-editor';

@Component({
  standalone: true,
  selector: 'app-dashboard',
  imports: [CargoEditor],
  template: `
    <app-cargo-editor></app-cargo-editor>
    <p>
      ToDo: CargoList!
    </p>
  `,
  styleUrl: './dashboard.css',
})
export class Dashboard {

}
