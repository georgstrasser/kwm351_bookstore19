import { ActivatedRoute, Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, FormArray, Validators } from '@angular/forms';

import { BookFormErrorMessages } from './book-form-error-messages';
import {BookFactory} from "../shared/book-factory";
import {BookStoreService} from "../shared/book-store.service";
import {Book, Image} from "../shared/book";
import {BookValidators} from '../shared/book-validators';
import {AuthService} from "../shared/authentication.service";

@Component({
  selector: 'bs-book-form',
  templateUrl: './book-form.component.html'
})
export class BookFormComponent implements OnInit {
  bookForm: FormGroup;
  book = BookFactory.empty();
  errors: { [key: string]: string } = {};
  isUpdatingBook = false;
  images: FormArray;
  authors: FormArray;

  constructor(private fb: FormBuilder, private bs: BookStoreService,
              private route: ActivatedRoute, private router: Router,
              private auth: AuthService) { }

  ngOnInit() {
    const isbn = this.route.snapshot.params['isbn'];
    if (isbn) {
      this.isUpdatingBook = true;
      this.bs.getSingle(isbn).subscribe(book => {
        this.book = book;
        this.initBook();
      });
    }
    this.initBook();
  }

  initBook() {
    this.buildThumbnailsArray();
    this.buildAuthorsArray();

    this.bookForm = this.fb.group({
      id: this.book.id,
      title: [this.book.title, Validators.required],
      subtitle: this.book.subtitle,
      isbn: [this.book.isbn, [
        Validators.required,
        Validators.minLength(10),
        Validators.maxLength(13)
      ]],
      description: this.book.description,
      rating: [this.book.rating,[
        Validators.min(0),
        Validators.max(10)
      ]],
      authors: this.authors,
      images: this.images,
      published: new Date(this.book.published),
      price: [this.book.price, [
        Validators.min(1)
      ]]
    });

    console.log(new Date(this.book.published));
    this.bookForm.statusChanges.subscribe(
      () => this.updateErrorMessages());
  }

  buildThumbnailsArray() {
    console.log(this.book.images);

    this.images = this.fb.array(
      this.book.images.map(
        t => this.fb.group({
          id: this.fb.control(t.id),
          url: this.fb.control(t.url),
          title: this.fb.control(t.title)
        })
      ),BookValidators.atLeastOneImage
    );
  }

  buildAuthorsArray() {
      console.log(this.book.authors);

      this.authors = this.fb.array(
          this.book.authors.map(
              t => this.fb.group({
                  id: this.fb.control(t.id),
                  firstName: this.fb.control(t.firstName),
                  lastName: this.fb.control(t.lastName)
              })
          ),BookValidators.atLeastOneAuthor
      );
  }


  addThumbnailControl() {
    this.images.push(this.fb.group({ url: null, title: null }));
  }
  removeThumbnailControl(index){
    this.images.removeAt(index);
  }

  addAuthorControl() {
      this.authors.push(this.fb.group({ firstName: null, lastName: null }));
  }
  removeAuthorControl(index){
      this.authors.removeAt(index);
  }

  submitForm() {
    // filter empty values
    this.bookForm.value.images = this.bookForm.value.images.
    filter(thumbnail => thumbnail.url);
    this.bookForm.value.authors = this.bookForm.value.authors.
    filter(thumbnail => thumbnail.firstName || thumbnail.lastName);

    const book: Book = BookFactory.fromObject(this.bookForm.value);
//deep copy  - did not work without??
    book.images = this.bookForm.value.images;

    //just copy the authors
    book.authors = this.bookForm.value.authors;

    if (this.isUpdatingBook) {
      this.bs.update(book).subscribe(res => {
        this.router.navigate(['../../books', book.isbn], { relativeTo: this.route });
      });
    } else {
      book.user_id = this.auth.getCurrentUserId();
      this.bs.create(book).subscribe(res => {
        //this.book = BookFactory.empty();
        //this.bookForm.reset(BookFactory.empty());
        this.router.navigate(['../books'], { relativeTo: this.route });
      });
    }
  }

  updateErrorMessages() {
    this.errors = {};
    for (const message of BookFormErrorMessages) {
      const control = this.bookForm.get(message.forControl);
      if (control &&
        control.dirty &&
        control.invalid &&
        control.errors[message.forValidator] &&
        !this.errors[message.forControl]) {
        this.errors[message.forControl] = message.text;
      }
    }
  }
}
