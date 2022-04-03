<template>
  <form class="form">
    <textarea
      id="body"
      cols="28"
      rows="5"
      class="form-input"
      @keydown="typing"
      v-model="body"
    >
    </textarea>
    <label
      >Attach a File:
      <input type="file" ref="uploadInput" multiple accept="image/*" />
    </label>
    <span class="notice"> Hit Return to send a message </span>
    <span> </span>
  </form>
</template>

<script src="/xampp/htdocs/ChatApp/node_modules/socketio-file-upload/client.js"></script>
<script>
import Event from "../events.js";

const { io } = require("socket.io-client");
const SocketIOFileUpload = require("socketio-file-upload");
export default {
  data() {
    return {
      body: null,
      attachment: null,
    };
  },
  mounted() {
    this.socketInstance = io("http://localhost:3000");
    var siofu = new SocketIOFileUpload(this.socketInstance);
    siofu.listenOnInput(this.$refs.uploadInput);

    siofu.addEventListener("progress", (event) => {
      var percent = (event.bytesLoaded / event.file.size) * 100;
      console.log("File is", percent.toFixed(2), "percent loaded");
    });
    siofu.addEventListener("complete", (event) => {
      console.log(event.detail.nameOfImage);
      this.attachment = event.detail.pathName;
    });
  },
  methods: {
    typing(e) {
      if (e.keyCode === 13 && !e.shiftKey) {
        e.preventDefault();
        this.sendMessage();
      }
    },
    sendMessage() {
      if (!this.body || this.body.trim() === "") {
        return;
      }
      let messageObj = this.buildMessage();
      axios
        .post("/message", {
          id: Date.now(),
          body: this.body,
          selfMessage: true,
          name: Laravel.user.name,
          attachment: this.attachment,

        })
        .catch(() => {
          console.log("failed");
        });
      this.socketInstance = io("http://localhost:3000");
      this.socketInstance.emit("message", messageObj);
      this.body = null;
      this.attachment = null;
    },
    buildMessage() {
      return {
        id: Date.now(),
        body: this.body,
        selfMessage: true,
        name: Laravel.user.name,
        attachment: this.attachment,
      };
    },
  },
};
</script>

<style>
.form {
  padding: 8px;
}
.form-input {
  width: 100%;
  border: 1px solid #d3e0e9;
  padding: 5px 10px;
  outline: none;
}
.notice {
  color: #aaa;
}
</style>