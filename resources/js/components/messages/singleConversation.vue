<template>
  <div class="all-chat-messages">
    <div class="all-messages-header">
      <i v-touch:tap="closeSingleChat" class="fas fa-chevron-left" style></i>
    </div>
    <div class="chat-messages">
      <div
        style="display:flex; align-items:center;"
        v-for="message in singleconversation.messages"
        :key="message.id"
      >
        <div class="img">
          <img :src="'/storage/user_images/'+ singleconversation.profile_picture" alt />
        </div>
        <div class="single-message-wrap">
          <p>{{message.message_content}}</p>
        </div>
      </div>
      <div class="messages" style="display:flex; align-items:center;" v-for="message in messages" :key="message.id">
        <div class="img">
          <img :src="'/storage/user_images/'+ singleconversation.profile_picture" alt />
        </div>
        <div class="single-message-wrap">
          <p>{{message.message}}</p>
        </div>
      </div>
    </div>
      <div class="send-message">
        <i class="far fa-images"></i>
        <input type="text" class="message-input" v-model="message" placeholder="Aa" v-on:click="openInput"/>
        <i class="far fa-paper-plane" @click="sendmessage()"></i>
      </div>
  </div>
</template>

<script>
import { EventBus } from "../../app";
import { setTimeout } from "timers";

export default {
  data() {
    return {
      show: false,
      messages: "",
      currentUrl: window.location.pathname,
      singleconversation: {},
      conversationID: "",
      show: false,
      username: "",
      message:'',
      messages:[],
      user:''
    };
  },
  mounted() {
    axios.get("/api/user").then(response => {
      this.user = response.data;
    });
    EventBus.$on("closeSingleMesage", () => {
      this.$anime({
        targets: ".all-chat-messages",
        height: 0,
        width: 0
      });
    });
    EventBus.$on("getConversationID", id => {
      this.conversationID = id;
      axios.get("/api/conversations/" + this.conversationID).then(response => {
        this.singleconversation = response.data;
        this.username = response.data.name;
        EventBus.$emit("sendUsername", this.username);
      });
        this.$anime({
        targets: ".all-chat-messages",
        easing:'linear',
        translateX: 0,
        duration: 200,
        opacity: 1,
        "z-index": 18
      });
        this.$anime({
        targets:'.users-wrap',
        translateX:-$('.users-wrap').width() - 100,
        easing: "linear",
        duration: 150,
        // delay: 250
      })
      $('.fa-comment').css({'display':'none'})
    });
  },
  methods: {
    sendmessage(){
      let data = {message_content:this.message}
    },
    openInput(){
      this.$anime({
        targets:'.message-input',
        padding:10,
        borderRadius:40,
        easing:'linear',
        duration:250
      })
      this.$anime({
        targets:'.fa-images',
        width: 0,
        height: 0,
        'visibility': 'hidden',
        opacity: 0,
        display: 'none',
      })
      this.$anime({
        targets:'.fa-paper-plane',
        padding:20,
        duration:150,
        easing:'linear'
      })
    },
    closeSingleChat() {
      $('.fa-comment').css({'display':'block'})
      var el = $(".all-chat-messages").width();
      this.message = ''
      this.$anime({
        targets: ".all-chat-messages",
        easing:'linear',
        translateX: el,
        duration: 150,
        opacity: 1,
        "z-index": 18
      });
      this.$anime({
        targets: ".fa-chevron-down",
        rotate: "0deg"
      });
      this.$anime({
        targets: ".single-chat-main-heading",
        keyframes: [
          { translateY: 40, opacity: 0, duration: 10, easing: "linear" }
        ]
      });
      this.$anime({
        targets: ".chat-main-heading",
        translateY: 0,
        opacity: 1,
      });
      let userswrap = $(".users-wrap").width() + 50;
      this.$anime({
        targets: ".users-wrap",
        translateX: 0,
        easing: "linear",
        duration: 200,
        delay: 150
      });
    }
  }
};
</script>

