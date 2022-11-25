import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './Auth/login/login.component';
import { RegisterComponent } from './Auth/register/register.component';
import { AdminDashboardComponent } from './Dashboard/admin-dashboard/admin-dashboard.component';
import { UserDashboardComponent } from './Dashboard/user-dashboard/user-dashboard.component';
import { AuthGuard } from './AuthGuard/auth.guard';
import { AllUsersComponent } from './Dashboard/all-users/all-users.component';
const routes: Routes = [
  { path: '', component: LoginComponent },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'user-dashboard', component: UserDashboardComponent, canActivate: [AuthGuard] },
  { path: 'admin-dashboard', component: AdminDashboardComponent, canActivate: [AuthGuard] },
  { path: 'all-users', component:AllUsersComponent , canActivate: [AuthGuard] },





];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
