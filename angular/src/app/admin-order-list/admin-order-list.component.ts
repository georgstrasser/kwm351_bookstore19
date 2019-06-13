import { ActivatedRoute, Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import {Order} from "../shared/order";
import {OrderService} from "../shared/order.service";
import {State} from "../shared/state";
import {StateFactory} from "../shared/state-factory";

@Component({
    selector: 'bs-admin-order-list',
    templateUrl: './admin-order-list.component.html',
    styles: []
})
export class AdminOrderListComponent implements OnInit {

    orders : Order[];
    constructor(
        private os: OrderService,
        private router: Router
    ) { }

    ngOnInit() {

        this.os.getAll().subscribe(
            res => {
                this.orders = res;
                console.log(this.orders);
            });

    }

    addState(stateText, order_id){
        let comment = prompt("Geben Sie einen Kommentar zur Statusänderung ein:");
        if(comment!=null){

            let state = new State(
                null,
                stateText,
                new Date(),
                comment,
                order_id
            );

            state = StateFactory.fromObject(state);
            console.log(state);

            this.os.addState(state).subscribe(res => {
                this.router.navigate(['../books']);
            });

        }
    }

    isPaid(states){
        for(let state of states){
            if(state.state == 'Bezahlt'){
                return true;
            }
        }
        return false;
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

    statePaid(orderID){
        this.addState('Bezahlt', orderID);
    }

    stateShipped(orderID){
        this.addState('Versendet', orderID);
    }

    stateCancelled(orderID){
        this.addState('Storniert', orderID);
    }

}
