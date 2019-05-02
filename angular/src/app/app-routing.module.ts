import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {HomeComponent} from './home/home.component';
import {BookListComponent} from './book-list/book-list.component';
import {BookDetailsComponent} from './book-details/book-details.component';
import {BookFormComponent} from './book-form/book-form.component';
import {LoginComponent} from './login/login.component';

const routes: Routes = [
  {path:'',redirectTo: 'home', pathMatch:'full'},
  {path:'home',component: HomeComponent},
  {path:'books',component: BookListComponent},
  {path:'books/:isbn',component: BookDetailsComponent},
  {path:'admin',component: BookFormComponent},
  {path:'admin/:isbn',component: BookFormComponent},
  {path:'login',component: LoginComponent},
]

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
