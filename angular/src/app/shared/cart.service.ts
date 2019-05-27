import { Injectable } from '@angular/core';
import {Observable, of, throwError} from "rxjs";
import {Book} from "./book";
import {BookFactory} from "./book-factory";
import {AuthService} from "./authentication.service";
import {HttpClient} from "@angular/common/http";
import {assertNumber} from "@angular/core/src/render3/assert";

@Injectable({
    providedIn: 'root'
})

export class CartService {

    private api= "http://bookstore19.s1610456033.student.kwmhgb.at/api";

    public books: Book[] = new Array();
    public positions = new Array();
    public sum: number = 0;
    public vat = 10;
    public vatAmount = 0;
    public gross: number = 0;

    constructor(
        private auth: AuthService,
        private http: HttpClient) {
    }

    add(cartBook: Book, quantity: number, price: number){
        /*
        let position = {
            book: cartBook,
            quantity: number,
            price: number
        };
        */
        this.positions.push(position);
        console.log(this.positions);
        //TODO work with quantity and price
        this.books.push(cartBook);
        localStorage.setItem(cartBook.isbn, JSON.stringify(cartBook));

        for(let i = 0; i < localStorage.length; i++){
            let value = localStorage.getItem(localStorage.key(i));
            if (value[0] === "{") {
                value = JSON.parse(value);
            }
        }
        this.syncWithJSON();
    }

    calculatePrices(): Observable<{sum: number, vat: number, vatAmount: number, gross:number}>{
        this.sum = 0;
        for(let book of this.books) {
            this.sum += book.price;
        }
        this.vatAmount = this.sum*this.vat/100;
        this.vatAmount = parseFloat(this.vatAmount.toFixed(2));
        this.gross = this.sum + this.vatAmount;
        return of({sum: this.sum, vat: this.vat, vatAmount: this.vatAmount, gross: this.gross});
    }

    clearStorage() {
        const token = localStorage.getItem("token");
        const userId = localStorage.getItem("userId");
        const isAdmin = localStorage.getItem("isAdmin");
        localStorage.clear();

        if (token && userId && isAdmin){
            localStorage.setItem("token", token);
            localStorage.setItem("userId", userId);
            localStorage.setItem("isAdmin", isAdmin);
        }
        this.syncWithJSON();
    }

    deleteItemById(itemId){
        localStorage.removeItem(itemId);
    }

    syncWithJSON(): Observable<Array<Book>> {
        this.books = new Array();
        for(let i=0; i<localStorage.length; i++){
            let currentBook = localStorage.getItem(localStorage.key(i));
            if(currentBook[0] === "{"){
                currentBook = JSON.parse(currentBook);
                let book : Book = BookFactory.fromObject(currentBook);
                this.books.push(book);
            }
        }
        this.calculatePrices();
        return of(this.books);
    }

    private errorHandler(error: Error | any): Observable<any>{
        return throwError(error);
    }

}