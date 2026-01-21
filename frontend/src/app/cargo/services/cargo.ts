import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs'

@Injectable({
  providedIn: 'root',
})
export class CargoService {
  private apiUrl = 'http://localhost:8080/api/cargo';

  constructor(private http: HttpClient) { }

  submitCargoData(data: any): Observable<any> {
    return this.http.post(this.apiUrl, data, {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
      }),
    });
  }
}