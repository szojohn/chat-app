<template>
  <div class="message-area" ref="message">
    <message-component
      v-for="message in messages"
      :key="message.id"
      :message="message"
    >
    </message-component>
  </div>
</template>

<script>
import Event from "../events.js";
import Loading from "./Loading.vue";

// const getMessage = async () => {
//   await new Promise((resolve) => setTimeout(resolve, 1000));
//   const result = message;
//   return result;
// };

// const AsyncComponent = () => ({
//   // The component to load (should be a Promise)
//   component: import('./MessageComponent.vue'),
//   loading: Loading,
//   delay: 500,
//   timeout: 3000
// })
const { io } = require("socket.io-client");
export default {
  data() {
    return {
      messages: [],
    };
  },
  mounted() {
    axios.get("/message").then((response) => {
      this.messages = response.data;
    });

    this.socketInstance = io("http://localhost:3000");
    this.socketInstance.on("message:received", (data) => {
      this.messages = this.messages.concat(data);
      if (data.selfMessage) {
        this.$refs.message.scrollTop = 0;
      }
    });
  },
};
</script>
<style>
.message-area {
  height: 400px;
  max-height: 400px;
  overflow-y: scroll;
  padding: 15px;
  border-bottom: 1px solid #eee;
}
</style>