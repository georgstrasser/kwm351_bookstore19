import { Component, OnInit } from '@angular/core';
import {Order} from "../shared/order";
import {OrderService} from "../shared/order.service";
import {Book} from "../shared/book";

@Component({
  selector: 'bs-admin-order-list',
  templateUrl: './admin-order-list.component.html',
  styles: []
})
export class AdminOrderListComponent implements OnInit {

    orders : Order[];
    constructor(
        private os: OrderService
    ) { }

    ngOnInit() {

        this.os.getAll().subscribe(
            res => {
                this.orders = res;
                for(let i=0; i<this.orders.length; i++){
                    for(let j=0; j<this.orders[i].positions.length; j++){
                        //creating a default book
                        this.orders[i].positions[j].book = new Book(0,'','',[],new Date,0,0);
                        this.os.getBookByID(this.orders[i].positions[j].book_id).subscribe(res => {
                            this.orders[i].positions[j].book = res;
                        });

                    }
                }
                console.log(this.orders);
        });

    }

}
