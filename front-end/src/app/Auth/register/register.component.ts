import { Component, OnInit } from '@angular/core';
import { _MRegisterModal } from './Model/registerClass';
import { IRegisterDetails } from './Model/registerInterface';
import { CommonServiceService } from '../../Service/common-service.service';
import { FormBuilder,FormGroup,FormControl,Validators } from '@angular/forms';
import { Router } from '@angular/router';


@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {
  registerForm: any = FormGroup;
  registerObj: _MRegisterModal = new _MRegisterModal();
  errorMsg: any = [];




  constructor(private fb:FormBuilder,private service:CommonServiceService,private router:Router) { }

  ngOnInit(): void {
    this.registerObj;
    this.buildForm();
  }

  buildForm() {
    this.registerForm = this.fb.group({
      name: new FormControl('', Validators.required),
      email: new FormControl('', Validators.required),
      password: new FormControl('', Validators.required),
    });
  }

  loginComponent(){
    this.router.navigate(['login']);
  }

  registerUser(){
      if ((this.registerForm.value.name.length && this.registerForm.value.email.length && this.registerForm.value.password.length) !== 0) {
        this.registerObj.name = this.registerForm.value.name;
        this.registerObj.email = this.registerForm.value.email;
        this.registerObj.password = this.registerForm.value.password;

        this.service.addUser(this.registerObj).subscribe((response: any) => {
            if (response.results.status_code == 200 && response.results.status == true ) {

              alert('Registered successfully you can login using your credentials  (email and password)')
              this.ngOnInit();
            }
          },
          (err :any) => {
            this.errorMsg = err.error.errors;
          });
      }

  }

}
