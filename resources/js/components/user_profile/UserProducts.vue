<template :key="compKey">
  <div class="user-products-list-wrap">
    <h2>Tvoji oglasi</h2>
    <div class="user-products">
      <v-touch
        v-for="(product) in products"
        :key="product.id"
        v-on:swipeleft.prevent="showOptions(product,$event)"
        v-on:swiperight.prevent="hideOptions(product,$event)"
        ref="target"
      >
        <div class="product">
          <router-link  :to="'/products/'+product.id" class="product-item">
            <div class="product-heading">
              <div class="img">
                <img :src="'/storage/products/'+product.image">
              </div>
              <div class="product-content">
                <h6>{{product.title}}</h6>
                <p class="description">{{product.description}}</p>
                <p>{{product.price}} RSD</p>
              </div>
            </div>
          </router-link>
          <options :id="product.id"></options>
        </div>
      </v-touch>
    </div>
  </div>
</template>

<script>
import options from "./UserOptions";
import {EventBus} from '../../app';
export default {
  components: {
    options: options
  },
  props: ["products", "ids"],
  data() {
    return {
      user: [],
      currentUrl: window.location.pathname,
      toggle: "fa-toggle-on",
      show: false,
      hide: true,
      compKey:0
      // products:''
    };
  },
  created() {
    // console.log(this.ids);
    EventBus.$on('clickedItemId',(id)=>{
      this.products.splice(this.products.indexOf(this.products.id), 1);
      return this.products;
    })
  },
  methods: {
    showOptions(product, event) {
      this.ids.forEach(el => {
        if (product.id == el) {
          $(event.target.nextElementSibling).addClass("visible");
          $(event.target.nextElementSibling.childNodes).addClass("visible");
          this.$anime({
            targets: event.target.nextElementSibling,
            // scaleX:1,
            translateX: 0,
            easing: "easeInSine",
            width: "30%",
            duration: 300
          });
          this.$anime({
            targets: ".edit",
            translateX: 0,
            duration: 300
          });
          this.$anime({
            targets: ".delete",
            translateX: 0,
            duration: 300
          });
          this.$anime({
            targets: event.target,
            translateX: -20,
            easing: "easeInSine",
            duration: 300
          });
        }
      });
    },
    hideOptions(product, event) {
      this.ids.forEach(el => {
        if (product.id == el) {
          this.$anime({
            targets: event.target.nextElementSibling,
            translateX: "50px",
            easing: "easeOutSine",
            width: "0",
            duration: 300
          });
          this.$anime({
            targets: event.target,
            translateX: 0,
            easing: "easeOutSine",
            duration: 300
          });
          this.$anime({
            targets: ".edit",
            translateX: 13,
            duration: 300
          });
          this.$anime({
            targets: ".delete",
            translateX: -11,
            duration: 300
          });
        }
      });
    }
  }
};
</script>
