import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CargoService } from '../services/cargo';

@Component({
  standalone: true,
  selector: 'app-cargo-editor',
  imports: [FormsModule, CommonModule],
  templateUrl: './cargo-editor.html',
  styleUrl: './cargo-editor.css',
})
export class CargoEditor {

  constructor(private cargoService: CargoService) {}

  onSubmit(formData: any) {
    this.cargoService.submitCargoData(formData).subscribe({
      next: (response) => {
        console.log('Erfolg:', response);
      },
      error: (error) => {
        console.error('Fehler:', error);
      }
    });
  }

  amountEvent(event: KeyboardEvent): void {
    if (event.key === '-' || event.key === '+') {
      event.preventDefault();
    }
  }
  weightEvent(event: KeyboardEvent): void {
    if (event.key === '-' || event.key === '+') {
      event.preventDefault();
    }
  }
}
