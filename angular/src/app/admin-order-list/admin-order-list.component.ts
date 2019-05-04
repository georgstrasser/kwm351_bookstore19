import { Component, OnInit } from '@angular/core';
import {Order} from "../shared/order";
import {OrderService} from "../shared/order.service";

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
                console.log(this.orders);
            });
    }

}
