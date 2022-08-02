import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { User } from 'src/app/models/User';
import { AccountService } from 'src/app/services/account.service';
import { OrdersService } from 'src/app/services/orders.service';
import { ProductsService } from 'src/app/services/products.service';

@Component({
  selector: 'app-orders',
  templateUrl: './orders.component.html',
  styleUrls: ['./orders.component.css'],
})
export class OrdersComponent implements OnInit {
  public orders: Array<any> = [];
  user!: User | null;
  public disabled = true;

  constructor(
    private accountService: AccountService,
    private ordersService: OrdersService,
    private productsService: ProductsService,
  ) {
    this.accountService.user.subscribe((user) => {
      this.user = user;
    });
  }

  ngOnInit() {
    this.getOrders();
  }

  getOrders() {

    return this.ordersService
      .getOrdersById(JSON.stringify(this.user))
      .subscribe(() => {
        this.ordersService.orders.subscribe((res) => {
          if(res.length>0){
            this.orders = [];
            this.orders = res;
          } else {
            this.orders = [];
          }
        });
      });
  }

  delete(id: any) {
    let orderId = {id_order : id};
    this.changeNum(id);

    return this.ordersService.deleteOrder(JSON.stringify(orderId)).subscribe(() => this.ngOnInit() );
  }

  changeNum(id: any) {
    let dataProducts = {
      products:[] = this.orders.filter(x => x.id_order == id)[0]['products']
    }
    return this.productsService.changeNumProducts(JSON.stringify(dataProducts)).subscribe();
  }
}
