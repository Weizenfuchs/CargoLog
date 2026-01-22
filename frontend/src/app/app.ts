import { Component } from '@angular/core';
import { Dashboard } from './dashboard/dashboard';
import { CargoEditor } from './cargo/cargo-editor/cargo-editor';

@Component({
  standalone: true,
  selector: 'app-root',
  imports: [
    Dashboard,
    CargoEditor,
  ],
  template: `
    <div class="app-container">
      <header>
        <img src="logo.jpg" alt="ttc Logo" class="logo" />
        <h1>CargoLog</h1>
      </header>
      <body>
        <main>
          <app-dashboard></app-dashboard>
        </main>
      </body>
    </div>
  `,
  styleUrls: ['./app.css'],
})
export class App {
  title = 'cargolog';
}
