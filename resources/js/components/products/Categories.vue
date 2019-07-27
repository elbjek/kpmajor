<template>
    <div class="category-wrap">
        <h3>Kategorije</h3>
        <carousel :perPage="2.5" :paginationEnabled="false" :easing="'linear'" :loop="true"  :speed="500" >
            <slide class="product"  v-for="(category,index) in categories" :key="index">
                <router-link  :to="'/categories/'+category._id" class="cat-link">
                    <div class="img">
                        <img :src="'/storage/products/'+category.image" alt="">
                    </div>
                    <div class="category-heading">
                        <p>KATEGORIJA</p>
                        <h5>{{category.title}}</h5>
                    </div>
                </router-link>
            </slide>
        </carousel>
    </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';
import {EventBus} from '../../app';
    export default {
         components: {
            "carousel": Carousel,
            "slide": Slide
        },
        data() {
            return {
                'categories': [],
                'allImages':[],
            
            }
        },
        beforeMount() {
            this.fetchData();
        },
        methods:{
            fetchData(){
                axios.get('/api/categories')
                .then((response) => {
                    this.categories= response.data;
                    console.log(this.categories)
                })
            },
        },
    }
</script>
