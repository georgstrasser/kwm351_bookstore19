import {Component, OnInit} from '@angular/core';
import {Book} from '../shared/book';
import {BookStoreService} from '../shared/book-store.service';
import {ActivatedRoute, Router} from '@angular/router';
import {BookFactory} from '../shared/book-factory';
import {AuthService} from '../shared/authentication.service';
import {CartService} from "../shared/cart.service";
import {FormBuilder, FormControl, FormGroup} from "@angular/forms";

@Component({
  selector: 'bs-book-details',
  templateUrl: './book-details.component.html',
  styles: []
})
export class BookDetailsComponent implements OnInit {
  book: Book = BookFactory.empty();
  quantity: number;
  price: number;

  constructor(
    private bs : BookStoreService,
    private route: ActivatedRoute,
    private router: Router,
    public authService: AuthService,
    private cs: CartService,
    private fb: FormBuilder
  ) { }

  ngOnInit() {
    const params = this.route.snapshot.params;
    this.bs.getSingle(params['isbn']).subscribe(b => {
      this.book=b; console.log(this.book);
    });
    console.log(this.book);

    this.quantity = 1;

  }

  getRating(num: number){
    return new Array(num);
  }

  removeBook(){
    if(confirm('Buch wirklich löschen?')){
      this.bs.remove(this.book.isbn).subscribe(
        res => this.router.navigate(['../'],
          {relativeTo: this.route})
      )
    }
  }

  increaseQuantity(){
    this.quantity++;
  }

  decreaseQuantity(){
    if(this.quantity > 1){
        this.quantity--;
    }
  }

  addBookToCart(){
    this.price = this.book.price;
    this.cs.add(this.book, this.quantity, this.price);
  }

}
