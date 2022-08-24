import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  private _url: string = 'http://localhost:8000/';

  constructor(private http: HttpClient) { }

  getProducts() {
    return this.http.get<[]>(this._url + 'products');
  }

  changeNumProducts(data: any) {

    return this.http.put<[]>(this._url + 'products', data);
  }
}
