import { Component } from '@angular/core';
import { CargoEditor } from '../cargo/cargo-editor/cargo-editor';
import { CargoList } from '../cargo/cargo-list/cargo-list';

@Component({
  standalone: true,
  selector: 'app-dashboard',
  imports: [CargoEditor, CargoList],
  template: `
    <app-cargo-editor></app-cargo-editor>
    <app-cargo-list></app-cargo-list>
  `,
  styleUrl: './dashboard.css',
})
export class Dashboard {

}
