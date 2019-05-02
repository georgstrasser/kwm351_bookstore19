import {Component, Input, OnInit} from '@angular/core';
import {Book} from '../shared/book';

@Component({
  selector: 'a.bs-book-list-item',
  templateUrl: './book-list-item.component.html',
  styles: []
})
export class BookListItemComponent {
  @Input() book: Book;
  constructor() {}
}
