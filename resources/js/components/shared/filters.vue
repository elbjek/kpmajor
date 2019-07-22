<template>
  <div class="category-filters-wrap">
       <div class="category-filter-by">
          <p>Usluge
            <span>
              <i class="fas fa-chevron-right"></i>
            </span>
          </p>
          <p>Proizvod
            <span>
              <i class="fas fa-chevron-right"></i>
            </span>
          </p>
       </div>

      <!-- <ul class="category-list">
          <li v-for="category in categories" :key="category.id">
              <a href="#">
                  {{category.title}}
              </a>
          </li>
      </ul> -->
  </div>
</template>

<script>
import { EventBus } from "../../app";

export default {
  data() {
    return {
      categories: "",
      filters:['Proizvodjac','Mesto','Zamena','Kategorija']
    };
  },
  mounted() {
    this.getCategories();
    EventBus.$on('showCategoryFilters',()=>{
        $('.category-filters-wrap').addClass('show-category-filters')
        // this.$anime({
        //     targets:'.category-filter-by',

        //     translateY: 0,
        //     height: "100%",
        //     easing: "linear",
        //     // // opacity:1,
        //     duration: 4500,
        //     // scaleY:1
        // })
    })
  },
  methods: {
    getCategories() {
      axios.get("/api/categories").then(response => {
        this.categories = response.data;
        console.log(response.data);
      });
    }
  }
};
</script>

