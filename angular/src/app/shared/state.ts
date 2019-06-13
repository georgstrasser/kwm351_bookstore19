export class State {
    constructor(
        public id: number,
        public state: string,
        public state_date: Date,
        public comment: string,
        public order_id: number
    ){
    }
}