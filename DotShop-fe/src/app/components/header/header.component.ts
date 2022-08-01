import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { Product } from 'src/app/models/Product';
import { User } from 'src/app/models/User';
import { AccountService } from 'src/app/services/account.service';
import { OrdersService } from 'src/app/services/orders.service';
import { ProductsService } from 'src/app/services/products.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css'],
})
export class HeaderComponent implements OnInit {
  @Input() cartElems!: Product[];
  @Input() cartTotal!: number;
  @Input() cartNumber!: number;
  @Input() delete: any;
  @Input() disabled!: boolean;
  private dataOrder: any;
  private dataProducts: any;

  @Output() deleteId = new EventEmitter<number>();
  user!: User | null;

  constructor(
    private accountService: AccountService,
    private ordersService: OrdersService,
    private productsService: ProductsService
  ) {}

  ngOnInit(): void {
    this.accountService.user.subscribe((user) => {
      this.user = user;
    });
  }

  logout() {
    this.accountService.logout();
  }

  getIdProduct(id: number) {
    this.deleteId.emit(id);
  }

  createOrder() {
    this.dataOrder = {
      id_user: this.user?.id_user,
      products: []
    };
    this.dataProducts = {
      products:[]
    }


    for (let i = 0; i < this.cartElems.length; i++) {
      this.dataOrder.products.push({
        id_product: this.cartElems[i].id_product,
        product_quantity: this.cartElems[i].available_products,
      });
      this.dataProducts.products.push({
        id_product: this.cartElems[i].id_product,
        product_quantity: -this.cartElems[i].available_products,
      })
    }
    this.ordersService.createOrder(JSON.stringify(this.dataOrder)).subscribe();
    this.productsService.changeNumProducts(JSON.stringify(this.dataProducts)).subscribe();
  }
}
