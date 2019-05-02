import {
  HttpErrorResponse, HttpEvent, HttpHandler, HttpInterceptor, HttpRequest,
  HttpResponse
} from "@angular/common/http";

import {Injectable} from "@angular/core";
import {Observable} from 'rxjs';
import {tap} from 'rxjs/operators';

@Injectable()
export class JwtInterceptorService
  implements HttpInterceptor {

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {

    return next.handle(request).pipe(tap((event: HttpEvent<any>) => {
      if (event instanceof HttpResponse) {
        // do stuff with response if you want
      }
    }, (err: any) => {
      if (err instanceof HttpErrorResponse) {
        if (err.status === 401) {
          // redirect to the login route
          // or show a modal
          // http://jasonwatmore.com/post/2016/09/29/angular-2-user-registration-and-login-example-tutorial
          console.log("error");
          alert("Invalid login");
        }
      }
    }));
  }
}
