import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';

@Component({
  standalone: true,
  selector: 'app-cargo-editor',
  imports: [FormsModule, CommonModule],
  templateUrl: './cargo-editor.html',
  styleUrl: './cargo-editor.css',
})
export class CargoEditor {
  amountEvent(event: KeyboardEvent): void {
    if (event.key === '-' || event.key === '+') {
      event.preventDefault();
    }
  }
}
