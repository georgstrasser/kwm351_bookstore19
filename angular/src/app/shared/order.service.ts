import { Injectable } from '@angular/core';
import {Order} from './order';
import {User} from './user';
import {State} from './state';
import {HttpClient} from '@angular/common/http';
import {Observable, throwError} from 'rxjs/index';
import {catchError, retry} from 'rxjs/internal/operators';
import {Book} from "./book";

@Injectable({
  providedIn: 'root'
})
export class OrderService {

    private api = 'http://bookstore19.s1610456033.student.kwmhgb.at/api';

    constructor(private http: HttpClient) {}

    getAll(): Observable<Array<Order>> {
      return this.http.get(`${this.api}/orders`).pipe(retry(3)).pipe(catchError(this.errorHandler));
    }

    getUserOrders(user): Observable<Array<Order>> {
        return this.http.get(`${this.api}/user/${user}`).pipe(retry(3)).pipe(catchError(this.errorHandler));
    }

    getBookByID(id): Book{
        return this.http.get(`${this.api}/book/id/${id}`).
        pipe(retry(3)).pipe(catchError(this.errorHandler));
    }

    private errorHandler(error: Error | any): Observable<any> {
        return throwError(error);
    }
}
