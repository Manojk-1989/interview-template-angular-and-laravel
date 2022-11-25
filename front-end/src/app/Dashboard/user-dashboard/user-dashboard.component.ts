import { Component, OnInit } from '@angular/core';
import { _MUserDashboardModal } from '../user-dashboard/Model/userDashboardClass';
import { IUserDashboardDetails } from '../user-dashboard/Model/userDashboardInterface';
import { CommonServiceService } from '../../Service/common-service.service';
import { Router } from '@angular/router';
import { FormBuilder,FormGroup,FormControl,Validators } from '@angular/forms';


@Component({
  selector: 'app-user-dashboard',
  templateUrl: './user-dashboard.component.html',
  styleUrls: ['./user-dashboard.component.scss']
})
export class UserDashboardComponent implements OnInit {
  userObj: _MUserDashboardModal = new _MUserDashboardModal();
  userForm: any = FormGroup;
  errorMsg: any = [];


  constructor(private fb:FormBuilder,private service:CommonServiceService,private router:Router) { }

  ngOnInit(): void {    
    this.userObj = new _MUserDashboardModal();
    this.buildForm();
  }

  buildForm() {
    this.userForm = this.fb.group({
      formula: new FormControl('', Validators.required),
    });
  }


  calculatewithoutStep(){
    if ((this.userForm.value.formula.length) !== 0) {
      this.userObj.formula = this.userForm.value.formula;
      this.service.calculatewithoutStep(this.userObj).subscribe((response: any) => {
          if (response.status_code == 200 && response.status == true ) {
            

          }
        },
        (err :any) => {
          this.errorMsg = err.error.errors;
        });
    }

  }

  logOut(){
    if ((localStorage.getItem('access_token'))) {
      this.service.logoutUser(this.userObj).subscribe((response: any) => {
        localStorage.removeItem('access_token');
        localStorage.removeItem('role_type');
        localStorage.clear();
            this.router.navigate(['login']);
          
        });
    }

  }


}
