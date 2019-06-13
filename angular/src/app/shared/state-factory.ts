import { State } from './state';

export class StateFactory {

    static empty(): State {
        return new State(
            null,
            '',
            new Date(),
            '',
            null,
        );
    }

    static fromObject(rawState: any): State {
        return new State(
            rawState.id,
            rawState.state,
            typeof(rawState.state_date) === 'string' ?
                new Date(rawState.state_date) : rawState.state_date,
            rawState.comment,
            rawState.order_id
        );
    }
}
