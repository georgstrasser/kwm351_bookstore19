import { Component, OnInit } from '@angular/core';
import {CartService} from "../shared/cart.service";
import {Book} from "../shared/book";
import {AuthService} from "../shared/authentication.service";
import {Router} from "@angular/router";
import {OrderService} from "../shared/order.service";

@Component({
    selector: 'bs-cart',
    templateUrl: './cart.component.html',
    styles: []
})
export class CartComponent implements OnInit {

    public books: Book[];
    public total: {
        sum: number,
        vat: number,
        vatAmount: number,
        gross: number
    };

    constructor(
        private cs: CartService,
        private  authService: AuthService,
        private router: Router,
        private os: OrderService) {
            this.books = cs.books;
    }

    ngOnInit() {
        this.cs.syncWithJSON().subscribe(res => this.books = res);
        this.cs.calculatePrices().subscribe(res => this.total = res);
    }

    clearStorage(){
        this.cs.clearStorage();
        this.books = this.cs.books;
        this.total = {
            "sum": this.cs.sum,
            "vat": this.cs.vat,
            "vatAmount": this.cs.vatAmount,
            "gross": this.cs.gross
        };
    }

    buyBooks(){
        if(confirm("Wollen Sie diese Bücher kaufen? Der Warenkorb wird entleert.")){
            const userId = this.authService.getCurrentUserId();
        }
        this.clearStorage();
    }

    deleteBookFromCart(isbn){
        this.cs.deleteItemById(isbn);
        this.cs.syncWithJSON();
        this.books = this.cs.books;
        this.total = {
            "sum": this.cs.sum,
            "vat": this.cs.vat,
            "vatAmount": this.cs.vatAmount,
            "gross": this.cs.gross
        }
    }

    isLoggedIn(){
        return this.authService.isLoggedIn();
    }

    isAdmin() {
        return this.authService.isAdminUser();
    }

}