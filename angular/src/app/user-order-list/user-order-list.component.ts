import { Component, OnInit } from '@angular/core';
import {OrderService} from "../shared/order.service";
import {AuthService} from "../shared/authentication.service";
import {Order} from "../shared/order";
import {ActivatedRoute, Router} from "@angular/router";

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

        //let currentUserID = this.auth.getCurrentUserId();

        const params = this.route.snapshot.params;

        this.os.getUserOrders(params['user_id']).subscribe(
            res => {
                this.orders = res;
                console.log(this.orders);
        });
    }

}
