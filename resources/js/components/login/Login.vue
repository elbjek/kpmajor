<template>
   <div class="login-form-wrap">
     <h2>Prijavi se</h2>
     <form action="post" class="form" @submit.prevent="login">
       <div class="form-item">
        <label for="email">Email</label>
        <input id="email" type="email" v-model="fields.email" placeholder="Email" class="input-form" name="email" value="email" required autocomplete="email"  autofocus>
        <span class="bottom-border"></span>
       </div>
        <div class="form-item">
          <label for="email">Password</label>
          <input id="password" type="password" v-model="fields.password" placeholder="Password" class="input-form" name="password" value="password" required autocomplete="password"  autofocus>
          <span class="bottom-border"></span>  
       </div>
       <div class="submit">
          <button  class="button">
              Prijavi se
          </button>
          <router-link class="additional-btn" to="/register">Registruj se</router-link>
       </div>
     </form>
   </div>
</template>

<script>

  export default {
    data(){
      return{
        errorMessage:'Wrong e-mail or password!',
        email:'',
        password:'',
        fields:{},
        errors:{}
      }
    },
    methods:{
      login(){
        axios.post('/login',this.fields)
        .then(result=>{
          this.response = result;
          this.$router.go('/');
            $('.login-form-wrap').addClass('confirm') 
               setTimeout(()=>{
             $('.login-form-wrap').removeClass('confirm') 
             },1000)
        })
        .catch(error => {
          if (error.response.status === 422) {
             $('.login-form-wrap').addClass('shake') 
             setTimeout(()=>{
             $('.login-form-wrap').removeClass('shake') 
             },1000)
          this.errors = error.response.data.errors || {};
        } 

        if(jQuery.isEmptyObject(error.response.data.errors)){
              $(".input-form").removeClass('error-border')
            } else $(".input-form").addClass('error-border')
        })
      }
    }
  }
</script>
