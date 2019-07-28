<template>
  <div>
      <navigation :user="user"></navigation>
      <div class="container" style="padding-top:60px">
      <vue-page-transition name="fade-in-down">
        <router-view></router-view>
      </vue-page-transition>
      </div>
  </div>
</template>

<script>
import navigation from "../Navigation";
import footer from "../shared/footer";
export default {
  components: {
    navigation: navigation,
    "footer-component": footer
  },
  data() {
    return {
      user: ""
    };
  },
  mounted() {
    axios.get("/api/user").then(response => {
      this.user = response.data;
    });
  },
  methods: {
    beforeLeave(element) {
      this.prevHeight = getComputedStyle(element).height;
    }
  }
};
</script>

<style scoped>
.page-enter-active {
  transition: all 0.09s ease-in-out 0.02s;
}
.page-leave-active {
  transition: all 0.1s ease-in-out 0.02s;
}
.page-enter,
.page-leave-to {
  opacity: 0;
}
.page-enter {
  transform: translateX(40%);
}
.page-leave-to {
  transform: translateX(-40%);
}
</style>