<template>
  <div class="categories-wrap">
    <h3><span>Proizvodi u kategoriji:</span> {{categorytitle}}</h3>
    <div v-if="products.length > 0">
      <div class="products-wrap" v-for="(product,index) in products" :key="index">
        <router-link :to="'/products/'+product.product_id" class="product">
          <div class="product-item">
            <div class="img">
                <img :src="'/storage/products/' + product.image" alt />
            </div>
            <div class="product-item-heading">
              <h4>{{product.title}}</h4>
              <p><span>Grad:</span> {{product.city}}</p>
              <p><span>Korisnik:</span> {{product.name}}</p>
            </div>
          </div>
        </router-link>
      </div>
    </div>
      <div v-else>
        <p>Nema proizvoda u ovoj kategoriji.</p>
      </div>
  </div>
</template>

<script>
import { Carousel, Slide } from "vue-carousel";
import { EventBus } from "../../app";
import product from "../shared/product";
export default {
  components: {
    carousel: Carousel,
    slide: Slide,
    productitem: product
  },
  data() {
    return {
      products: [],
      currentUrl: window.location.pathname,
      images: [],
      categorytitle:''
    };
  },
  beforeMount() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get("/api" + this.currentUrl).then(response => {
        this.products = response.data;
        this.images = this.products.images;
        console.log(this.products)
        this.products.forEach(item => {
            this.categorytitle = item.category_title
        });
      });
    }
  }
};
</script>
