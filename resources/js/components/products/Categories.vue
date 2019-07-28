<template>
  <div class="category-wrap">
    <h3>Kategorije</h3>
    <carousel
      :perPage="2.5"
      :paginationEnabled="false"
      :easing="'linear'"
      :loop="true"
      :speed="500"
    >
      <slide class="product" v-for="(category,index) in categories" :key="index">
        <div class="cat-link">
          <div class="img">
            <img :src="'/storage/products/'+category.image" alt />
          </div>
          <div class="category-heading" @click="emitID(category._id)">
            <p>KATEGORIJA </p>
            <h5>{{category.title}}</h5>
          </div>
        </div>
      </slide>
    </carousel>
    <category :category="categoryid"></category>
  </div>
</template>

<script>
import { Carousel, Slide } from "vue-carousel";
import { EventBus } from "../../app";
import category from '../categories/Category'
export default {
  components: {
    carousel: Carousel,
    slide: Slide,
    category:category
  },
  data() {
    return {
      categories: [],
      allImages: [],
      show: false,
      categoryid:''
    };
  },

  created() {
    axios.get("/api/categories").then(response => {
      this.categories = response.data;
      this.categories.forEach(element => {
          this.categoryid = element._id
        //   console.log(this.categoryid)
      });
    });
  },
  methods: {
      emitID(id){
        //   console.log(id)
        let catID=id
          EventBus.$emit('emitID',catID)
      },
  }
};
</script>
