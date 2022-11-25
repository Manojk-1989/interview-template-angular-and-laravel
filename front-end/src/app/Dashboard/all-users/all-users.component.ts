import { Component, OnInit } from '@angular/core';
import { CommonServiceService } from '../../Service/common-service.service';
import { _MAllUsersModal } from './Model/allUsersClass';
import { IAllUsersDetails } from './Model/allUsersInterface';
import { Router } from '@angular/router';


@Component({
  selector: 'app-all-users',
  templateUrl: './all-users.component.html',
  styleUrls: ['./all-users.component.scss']
})
export class AllUsersComponent implements OnInit {
  allusers: IAllUsersDetails[] = [];
  userObj: _MAllUsersModal = new _MAllUsersModal();



  constructor(private service:CommonServiceService,private router:Router) { }

  ngOnInit(): void {
    this.getAllUsers();
    this.userObj = new _MAllUsersModal();

  }

  getAllUsers() {
    this.service.getAllUsers().subscribe(
      (response: any) => {
        console.log(response);
        if (response.results.status == true && response.results.status_code == 200) {
          this.allusers = response.results.data;
        }
      },
      (err) => {}
    );
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
