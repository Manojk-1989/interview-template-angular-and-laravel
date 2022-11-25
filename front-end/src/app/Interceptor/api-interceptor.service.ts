import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpInterceptor, HttpRequest, HttpHandler } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ApiInterceptorService {

  constructor() {}

  intercept(request: HttpRequest<any>, next: HttpHandler) {
    const accessToken = localStorage.getItem('access_token');
    request = request.clone({
      setHeaders: {
        Authorization: "Bearer " + accessToken
      }
    });

    return next.handle(request);
  }
}
