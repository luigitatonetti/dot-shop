import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AccountService } from 'src/app/services/account.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent implements OnInit {
  form!: FormGroup;
  submitted = false;
  loading = false;
  error = true;
  data: any;

  constructor(
    private formBuilder: FormBuilder,
    private accountService: AccountService,
    private router: Router
  ) {}

  ngOnInit() {
    this.form = this.formBuilder.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required],
    });
  }

  get f() {
    return this.form.controls;
  }

  onSubmit() {
    this.submitted = true;

    if (this.form.invalid) {
      this.loading = false;
      return;
    }

    this.loading = true;
    this.accountService.login(JSON.stringify(this.form.value)).subscribe({
      next: () => {
        this.router.navigate(['/dashboard']);
      },
      error: ()=> {
        this.error = false;
        this.loading = false;
      }
    });
  }


}
