import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { BehaviorSubject, map, Observable } from 'rxjs';
import { User } from '../models/User';

@Injectable({
  providedIn: 'root',
})
export class AccountService {
  private userSubject: BehaviorSubject<User | null>;
  public user: Observable<User | null>;

  private _url: string = 'http://localhost:8000/';

  constructor(private http: HttpClient, private router: Router) {

    if(localStorage.getItem('user')) {
      this.userSubject = new BehaviorSubject<User | null>(
        JSON.parse(localStorage.getItem('user')!)
      );
    } else {
      this.userSubject = new BehaviorSubject<User | null>(null);
    }

    this.user = this.userSubject.asObservable();
  }

  public get userValue() {
    return this.userSubject.value;
  }

  login(data: any) {
    return this.http.post<User>(this._url + 'readUser', data).pipe(
      map((user) => {
        localStorage.setItem('user', JSON.stringify(user));
        localStorage.setItem('logged', 'true');
        this.userSubject.next(user);
        return user;
      })
    );
  }

  register(data: any) {
    return this.http.post<User>(this._url + 'createUser', data).pipe(
      map((user) => {
        localStorage.setItem('user', JSON.stringify(user));
        localStorage.setItem('logged', 'true');
        this.userSubject.next(user);
        return user;
      })
    );
  }

  logout() {
    localStorage.setItem('logged', 'false');
    localStorage.removeItem('user');
    this.userSubject.next(null);
    this.router.navigate(['/login']);
  }
}
