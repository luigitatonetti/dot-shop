import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, map, Observable } from 'rxjs';
import { Orders } from '../models/Orders';

@Injectable({
  providedIn: 'root'
})
export class OrdersService {

  private ordersSubject: BehaviorSubject<any> = new BehaviorSubject(null);
  public orders: Observable<any> = this.ordersSubject.asObservable();

  private _url: string = 'http://localhost:8000/';

  constructor(private http: HttpClient) { }

  getOrdersById(data: any) {
    return this.http.post<Orders[]>(this._url + 'readOrder', data).pipe(
      map( (res: Array<Orders>) => {this.ordersSubject.next(res);})
    );
  }

  createOrder(data: any) {

    return this.http.post<[]>(this._url + 'createOrder', data);
  }

  deleteOrder(data: any) {
    return this.http.delete<[]>(this._url + 'order',{body: data} );
  }

}
