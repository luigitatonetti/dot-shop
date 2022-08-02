import { Component, OnInit, ViewChild } from '@angular/core';
import { Product } from 'src/app/models/Product';
import { User } from 'src/app/models/User';
import { AccountService } from 'src/app/services/account.service';
import { ProductsService } from 'src/app/services/products.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  public filteredProducts:Product[] = [];
  private allProducts:Product[] = [];
  public cartProducts:Product[] = [];
  private productsCounter: number = 0;
  public id!:number;
  public total: number = 0;
  public cartNum: number = 0;


  user!:User | null;

  constructor(private accountService: AccountService, private productsService: ProductsService) {
    this.accountService.user.subscribe(user => {this.user = user});
   }

  ngOnInit(): void {
    this.readProducts();
  }

  readProducts() {
    return this.productsService.getProducts().subscribe(
      res => {
        this.allProducts = res;
        this.filterProducts();
      }
    )
  }

  filterProducts() {
    for( let i = this.productsCounter; i<(this.productsCounter + 10); i++) {
      this.filteredProducts.push(this.allProducts[i]);
    }
    this.productsCounter += 10;
  }

  loadMore() {
    this.filterProducts();
  }

  canAddProduct(id: number){
    if(this.cartProducts.find(x => x.id_product == id)!.available_products < this.filteredProducts.find(x => x.id_product == id)!.available_products )
      return true;
    return false;
  }

  addToCart(id: number){


    if( this.cartProducts.find(x => x.id_product == id)){

      if(!this.canAddProduct(id)) {
        window.alert("Can't add more products");
        return;
      }
      this.cartNum++;
      this.cartProducts.find(x => x.id_product == id)!.available_products++;
      this.total += Number(this.filteredProducts.find(x => x.id_product == id)!.cost);
    }else {

      if(this.filteredProducts.find(x => x.id_product == id)!.available_products == 0){
        window.alert("Can't add more products");
        return;
      }

      this.cartNum++;
      this.cartProducts.push(Object.assign([], this.filteredProducts.find(x => x.id_product == id)!));
      this.cartProducts.find(x => x.id_product == id)!.available_products = 1;
      this.total += Number(this.filteredProducts.find(x => x.id_product == id)!.cost);
    }
  }

  deleteFromCart(id: number) {

    this.total -= Number(this.cartProducts.find(x => x.id_product == id)?.cost);
    if(this.cartProducts.find(x => x.id_product == id)!.available_products > 1){

      this.cartNum--;
      this.cartProducts.find(x => x.id_product == id)!.available_products--;
    }else{

      this.cartNum--;
      this.cartProducts = this.cartProducts.filter(x => x.id_product != id);
    }
  }

}
