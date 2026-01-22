import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs'

@Injectable({
  providedIn: 'root',
})
export class CargoService {
  private createCargoApiUrl = 'http://localhost:8080/api/cargo';
  private getAllCargosApiUrl = 'http://localhost:8080/api/cargo-list';

  constructor(private http: HttpClient) { }

  submitCargoData(data: any): Observable<any> {
    return this.http.post(this.createCargoApiUrl, data, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
      }),
    });
  }

  getCargoList(): Observable<any> {
    return this.http.get(this.getAllCargosApiUrl, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
      }),
    });
  }
}