import { Component, OnInit } from '@angular/core';
import {OrderService} from "../shared/order.service";
import {AuthService} from "../shared/authentication.service";
import {Order} from "../shared/order";
import {ActivatedRoute, Router} from "@angular/router";
import {Book} from "../shared/book";


@Component({
  selector: 'bs-user-order-list',
  templateUrl: './user-order-list.component.html',
  styles: []
})
export class UserOrderListComponent implements OnInit {

  orders: Order[];
  constructor(
        private os: OrderService,
        private auth: AuthService,
        private route: ActivatedRoute,
        private router: Router,
    ) { }

    ngOnInit() {


        const params = this.route.snapshot.params;

        this.os.getUserOrders(params['user_id']).subscribe(
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
