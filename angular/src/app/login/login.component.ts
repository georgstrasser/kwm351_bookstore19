import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import {AuthService} from "../shared/authentication.service";
import {OrderService} from "../shared/order.service";
import {User} from "../shared/user";


interface Response {
  response: string;
  result: {
    token: string;
  };
}

@Component({
  selector: 'bs-login',
  templateUrl: './login.component.html'
})
export class LoginComponent implements OnInit {

  currentUser: User = new User(0,'','','','','',false);
  loginForm: FormGroup;

  constructor(private fb: FormBuilder, private router: Router,
              private authService: AuthService, private os:OrderService) { }

  ngOnInit() {
    this.loginForm = this.fb.group({
      username: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required],
    });

    if(this.isLoggedIn()){
      this.os.getUserByID(this.authService.getCurrentUserId()).subscribe(
          res => {
            this.currentUser = res;
            console.log(res);
          }
      )
    }

  }

  login() {
    const val = this.loginForm.value;
    if (val.username && val.password) {
      this.authService.login(val.username, val.password).subscribe(res => {
        const resObj = res as Response;
        if (resObj.response === "success") {
          this.authService.setLocalStorage(resObj.result.token);
          this.router.navigateByUrl('/');
        }
      });
    }
  }

  isLoggedIn(){
    return this.authService.isLoggedIn();
  }

  logout(){
    this.authService.logout();
  }
}
