import { Component, signal } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { Dashboard } from './dashboard/dashboard';
import { AppRoutingModule } from './app-routing.module';

@Component({
  selector: 'app-root',
  imports: [
    RouterOutlet,
    Dashboard,
    AppRoutingModule,
  ],
  templateUrl: './app.html',
  styleUrl: './app.css'
})
export class App {
  protected readonly title = signal('cargolog');
}
