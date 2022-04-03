<template>
  <div class="message self">
    <strong class="user">{{ message.name }}</strong>
    <p id="messageBody" class="body">{{ message.body }}</p>
    <img v-bind:src="message.attachment" v-if="message.attachment != null" class="responsive" object-fit="cover" object-position="bottom" width=1000px max-width="100%">
  </div>
</template>

<script>
export default {
  props: ["message"],
  // mounted() {
  //   let myForm = document.getElementById('messageBody');
  //   let formData = new FormData(myForm);
  //   formData.append()
  // }
};
</script>

<style>
.user {
  font-weight: 800;
}
.body {
  margin-bottom: 0;
  white-space: pre-wrap;
}
.message {
  border-bottom: 1px solid #000000;
}
.self {
  background-color: #f0f0f0;
  padding: 10px;
}
</style>