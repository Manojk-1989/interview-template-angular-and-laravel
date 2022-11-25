import { Component, OnInit } from '@angular/core';
import { FormBuilder,FormControl,FormGroup,Validators } from '@angular/forms';
import { _MLoginModal } from './Model/loginClass';
import { ILoginDetails } from './Model/loginInterface';
import { CommonServiceService } from '../../Service/common-service.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  loginForm: any = FormGroup;
  loginObj: _MLoginModal = new _MLoginModal();
  errorMsg: any = [];
  errorStatusCode: any;
errorMessage: any;


  constructor(private fb:FormBuilder,
    private service:CommonServiceService,
    private router:Router) { }

  ngOnInit(): void {
    this.loginObj;
    this.buildForm();
    this.loginObj = new _MLoginModal();

  }

  buildForm() {
    this.loginForm = this.fb.group({
      email: new FormControl('', Validators.required),
      password: new FormControl('', Validators.required),
    });
  }

  registerComponent(){
    this.router.navigate(['register']);
  }

  loginUser(){
    if ((this.loginForm.value.email.length && this.loginForm.value.password.length) !== 0) {
      this.loginObj.email = this.loginForm.value.email;
      this.loginObj.password = this.loginForm.value.password;

      this.service.loginUser(this.loginObj).subscribe((response: any) => {

          if (response.status_code == 200 && response.status == true ) {
            console.log(response.user.role_id);
            localStorage.setItem('access_token', response.token);
            localStorage.setItem('role_type', response.user.role_id);

            if (response.user.role_id == 1) {
              this.router.navigate(['user-dashboard']);
            } else {
              this.router.navigate(['admin-dashboard']);
            }
          } else {
            console.log(response);
            this.errorStatusCode = response.results.status_code;
            this.errorMessage = response.results.message;

          }
        },
        (err :any) => {
          this.errorMsg = err.error.errors;
        });
    }

  }

}
