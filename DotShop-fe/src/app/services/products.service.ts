import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  private _url: string = environment.apiUrl;

  constructor(private http: HttpClient) { }

  getProducts() {
    return this.http.get<[]>(this._url + 'products');
  }

  changeNumProducts(data: any) {
    return this.http.put<[]>(this._url + 'product', data);
  }
}
