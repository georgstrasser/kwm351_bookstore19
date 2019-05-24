import {State} from './state';
import {Book} from "./book";

export class Order {
    public id: number;
    public order_date: Date;
    public total: number;
    public vat: number;
    public user_id: number;
    public books: Book[];
    public states: State[];
}
