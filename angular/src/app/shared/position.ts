import {Book} from "./book";

export class Position {
    constructor(
        public book: Book,
        public quantity: number,
        public price: number
    ) {}
}
