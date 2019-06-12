import {State} from './state';
import {Position} from './position';

export class Order {
    constructor(
        public id: number,
        public order_date: Date,
        public total: number,
        public vat: number,
        public user_id: number,
        public positions: Position[],
        public states: State[])
    {}
}
