import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { Product } from 'src/app/models/Product';
import { User } from 'src/app/models/User';
import { AccountService } from 'src/app/services/account.service';
import { DashboardComponent } from '../dashboard/dashboard.component';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.css']
})
export class ProductComponent implements OnInit {

  @Input() productDetail: Product = {
    id_product: 0,
    product_name: '',
    cost: 0,
    available_products: 0
  }

  @Output() idGiven = new EventEmitter<number>();

  user!:User | null;

  constructor(private accountService: AccountService) {
    this.accountService.user.subscribe(user => {this.user = user});
  }

  ngOnInit(): void {
  }

  getIdProduct(){

    this.idGiven.emit(this.productDetail.id_product);

  }


}
