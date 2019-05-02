import {Author} from './author';
import {Image} from './image';
export {Author} from './author';
export {Image} from './image';

export class Book {
  constructor(public id: number,
    public isbn: string,
    public title: string,
    public authors: Author[],
    public published: Date,
    public user_id: number,
    public subtitle?: string,
    public rating?: number,
    public images?: Image[],
    public description?: string
  ) {}
}
