import { Order } from './order';

export class OrderFactory {

    static empty(): Order {
        return new Order(
            null,
            new Date(),
            0,
            0,
            0,
            [],
            [{id: 0, state: '', state_date: new Date(), comment: ''}]
        );
    }

    static fromObject(rawOrder: any): Order {
        return new Order(
            rawOrder.id,
            typeof(rawOrder.order_date) === 'string' ?
                new Date(rawOrder.order_date) : rawOrder.order_date,
            rawOrder.total,
            rawOrder.vat,
            rawOrder.user_id,
            rawOrder.positions,
            rawOrder.states
        );
    }
}
