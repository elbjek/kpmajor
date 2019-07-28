<template>
  <div class="categories-wrap">
    <div class="cat-wrap-heading">
      <h3>
        <span>Proizvodi u kategoriji:</span>
        {{categorytitle}}
      </h3>
      <button @click="closeCategories">
        <i class="fa fa-times"></i>
      </button>
    </div>
    <div style="overflow:scroll; height:100%" v-if="products.length > 0">
      <div class="categories" style="overflow:scroll">
        <div class="category-product" v-for="(category, index) in products" :key="index">
          <router-link class="category-link" :to="'/products/'+category.id">
            <div class="img">
              <img :src="'/storage/products/'+category.image" alt />
            </div>
            <div class="category-product-heading" @click="emitID(category._id)">
              <h6>Ime proizvoda</h6>
              <h5>{{category.title}}</h5>
              <p><span>Lokacija:</span>{{category.city}}</p>
            </div>
          </router-link>
        </div>
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
  props: ["category"],
  data() {
    return {
      products: [],
      currentUrl: window.location.pathname,
      images: [],
      categorytitle: "",
      dataReady: false,
      categoryID: ""
    };
  },

  methods: {
    closeCategories() {
      $(".categories-wrap").removeClass("cat-product-visible");
      $("body").removeClass("overflow");
      $("html, body").animate(
        {
          scrollTop: $(".VueCarousel").offset().top
        },
        1000
      );
    },
  },

  beforeMount() {
    EventBus.$on("emitID", catID => {
      this.categoryID = catID;

      this.dataReady = !this.dataReady;

      if ($(".categories-wrap").hasClass("cat-product-visible")) {
        $(".categories-wrap").addClass(" cat-product-hidden");
        $("body").removeClass("overflow");
      } else {
        $(".categories-wrap").addClass("cat-product-visible");
        var nav = $('.navigation').height() -5
        $("html, body").animate(
          {
            scrollTop: $(".categories-wrap").offset().top - nav
          },
          600
        );
        $("body").addClass("overflow");
      }

      setTimeout(() => {
        axios.get("/api/categories/" + this.categoryID).then(response => {
          this.products = response.data;
          console.log(response.data)
          this.images = this.products.images;
          this.products.forEach(item => {
            this.categorytitle = item.category_title;
          });
        });
      }, 100);
    });
  }
};
</script>

