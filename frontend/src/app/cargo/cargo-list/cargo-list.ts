import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { CargoService } from '../services/cargo';

@Component({
  selector: 'app-cargo-list',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './cargo-list.html',
  styleUrls: ['./cargo-list.css'],
})
export class CargoList implements OnInit {
  cargoList: any[] = [];
  isLoading = true;
  errorMessage: string | null = null;

  constructor(private cargoService: CargoService) {}

  ngOnInit(): void {
    this.loadCargoList();
  }

  loadCargoList() {
    this.isLoading = true;
    this.errorMessage = null;

    this.cargoService.getCargoList().subscribe({
      next: (response) => {
        this.cargoList = response.data;
        this.isLoading = false;
      },
      error: (error) => {
        this.errorMessage = 'Fehler beim Laden der Fracht-Daten';
        this.isLoading = false;
      },
    });
  }
}
