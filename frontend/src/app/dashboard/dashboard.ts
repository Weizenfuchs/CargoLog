import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CargoEditor } from '../cargo/cargo-editor/cargo-editor';
import { CargoList } from '../cargo/cargo-list/cargo-list';

@Component({
  standalone: true,
  selector: 'app-dashboard',
  imports: [
    CommonModule,
    CargoEditor,
    CargoList,
  ],
  template: `
    <div class="dashboard">
      <section class="editor-section">
        <app-cargo-editor></app-cargo-editor>
      </section>
      
      <section class="list-section">
        <app-cargo-list></app-cargo-list>
      </section>
    </div>
  `,
  styleUrls: ['./dashboard.css'],
})
export class Dashboard {}