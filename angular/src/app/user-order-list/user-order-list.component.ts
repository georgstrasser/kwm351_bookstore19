import { Component, OnInit } from '@angular/core';
import {OrderService} from "../shared/order.service";
import {AuthService} from "../shared/authentication.service";
import {Order} from "../shared/order";
import {ActivatedRoute, Router} from "@angular/router";
import {StateFactory} from "../shared/state-factory";
import {State} from "../shared/state";

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

    isShipped(states){
        for(let state of states){
            if(state.state == 'Versendet'){
                return true;
            }
        }
        return false;
    }

    isCancelled(states){
        for(let state of states){
            if(state.state == 'Storniert'){
                return true;
            }
        }
        return false;
    }

    stateCancelled(order_id){
        let comment = prompt("Warum möchten Sie die Bestellung stornieren?");
        if(comment!=null){

            let state = new State(
                null,
                'Storniert',
                new Date(),
                comment,
                order_id
            );

            state = StateFactory.fromObject(state);
            console.log(state);

            this.os.addState(state).subscribe(res => {
                this.router.navigate(['../orders']);
            });

        }
    }

}
