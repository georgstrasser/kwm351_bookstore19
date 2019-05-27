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

    getBookByID(id): Observable<Book>{
        return this.http.get(`${this.api}/book/id/${id}`).
        pipe(retry(3)).pipe(catchError(this.errorHandler));
    }

    getUserByID(id): Observable<User>{
        return this.http.get(`${this.api}/user/id/${id}`).
        pipe(retry(3)).pipe(catchError(this.errorHandler));
    }

    create(order:Order):Observable<any> {
        console.log(order);
        return this.http.post(`${this.api}/order`,order).
        pipe(retry(3)).pipe(catchError(this.errorHandler));
    }

    remove(id:number):Observable<any> {
        return this.http.delete(`${this.api}/order/${id}`).
        pipe(retry(3)).pipe(catchError(this.errorHandler));
    }

    update(order:Order):Observable<any> {
        return this.http.put(`${this.api}/order/${order.id}`,order).
        pipe(retry(3)).pipe(catchError(this.errorHandler));
    }

    private errorHandler(error: Error | any): Observable<any> {
        return throwError(error);
    }
}
