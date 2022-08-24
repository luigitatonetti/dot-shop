import { Component, OnInit } from '@angular/core';
import { Product } from 'src/app/models/Product';
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
    private productsService: ProductsService
  ) {
    this.accountService.user.subscribe((user) => {
      this.user = user;
    });
  }

  ngOnInit(): void {
    this.ordersService
      .getOrdersById(JSON.stringify(this.user?.id_user))
      .subscribe(() => {
        this.ordersService.orders.subscribe((res) => {
          this.orders.push(res);
          this.orders = this.orders[0];
        });
      });
  }

  delete(id: any) {
    let dataProducts = {
      products:[] = this.orders.filter(x => x.id_order == id)[0]['products']
    }
    console.log(JSON.stringify(dataProducts));
    this.productsService.changeNumProducts(JSON.stringify(dataProducts)).subscribe();
    this.ordersService.deleteOrder(id).subscribe();
    location.reload();
  }
}
