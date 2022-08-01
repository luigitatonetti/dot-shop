import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AccountService } from 'src/app/services/account.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
})
export class RegisterComponent implements OnInit {
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
      first_name: ['', Validators.required],
      last_name: ['', Validators.required],
      username: ['', Validators.required],
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(8)]],
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
    this.accountService.register(JSON.stringify(this.form.value)).subscribe({
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
