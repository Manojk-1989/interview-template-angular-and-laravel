import { Injectable } from '@angular/core';
import { IRegisterDetails } from '../../../src/app/Auth/register/Model/registerInterface';
import { HttpClient, HttpParams, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { Observable } from 'rxjs';
import { ILoginDetails } from '../../../src/app/Auth/login/Model/loginInterface';
import { IAdminDashboardDetails } from '../Dashboard/admin-dashboard/Model/adminDashboardInterface';
import { IUserDashboardDetails } from '../Dashboard/user-dashboard/Model/userDashboardInterface';



@Injectable({
  providedIn: 'root'
})
export class CommonServiceService {

  constructor(private http: HttpClient, private router: Router) { }

  addUserURL = environment.addUserURL;
  loginUserURL = environment.loginUserURL;
  logoutUserURL = environment.logoutUserURL;
  calculatewithoutStepURL = environment.calculatewithoutStepURL;
  getAllUsersURL = environment.getAllUsersURL;
  calculatewithStepURL = environment.calculatewithStepURL;


  
  addUser(job: IRegisterDetails): Observable<IRegisterDetails> {
    return this.http.post<IRegisterDetails>(this.addUserURL, job);
  }

  loginUser(job: ILoginDetails): Observable<ILoginDetails> {
    return this.http.post<ILoginDetails>(this.loginUserURL, job);
  }

  

  getAllUsers(){
    return this.http.get(this.getAllUsersURL);
  }

  logoutUser(job: IAdminDashboardDetails): Observable<IAdminDashboardDetails> {
    return this.http.post<IAdminDashboardDetails>(this.logoutUserURL, job);
  }

  calculatewithoutStep(job: IUserDashboardDetails): Observable<IUserDashboardDetails> {
    return this.http.post<IUserDashboardDetails>(this.calculatewithoutStepURL, job);
  }

  calculatewithStep(job: IAdminDashboardDetails): Observable<IAdminDashboardDetails> {
    return this.http.post<IAdminDashboardDetails>(this.calculatewithStepURL, job);
  }

  

  

  

  
}
