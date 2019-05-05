import {Book} from './book';

export class Position {
    public id: number;
    public book_id: number;
    public book: Book;
    public quantity: number;
    public price: number;
}
