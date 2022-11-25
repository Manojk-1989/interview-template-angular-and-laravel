import { Component, OnInit } from '@angular/core';
import { CommonServiceService } from '../../Service/common-service.service';
import { _MAdminDashboardModal } from './Model/adminDashboardClass';
import { IAdminDashboardDetails } from './Model/adminDashboardInterface';
import { Router } from '@angular/router';
import { FormBuilder,FormGroup,FormControl,Validators } from '@angular/forms';



@Component({
  selector: 'app-admin-dashboard',
  templateUrl: './admin-dashboard.component.html',
  styleUrls: ['./admin-dashboard.component.scss']
})
export class AdminDashboardComponent implements OnInit {
  accessToken: any;
  adminObj: _MAdminDashboardModal = new _MAdminDashboardModal();
  adminForm: any = FormGroup;
  errorMsg: any = [];
  constructor(private fb:FormBuilder,private service:CommonServiceService,private router:Router) { }

  ngOnInit(): void {    
    this.adminObj = new _MAdminDashboardModal();
  }

  buildForm() {
    this.adminForm = this.fb.group({
      formula: new FormControl('', Validators.required),
    });
  }


  calculatewithStep(){
    if ((this.adminForm.value.formula.length) !== 0) {
      this.adminObj.formula = this.adminForm.value.formula;
      this.service.calculatewithStep(this.adminObj).subscribe((response: any) => {
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
      this.service.logoutUser(this.adminObj).subscribe((response: any) => {
        localStorage.removeItem('access_token');
        localStorage.removeItem('role_type');
        localStorage.clear();
            this.router.navigate(['login']);
          
        });
    }

  }

}
