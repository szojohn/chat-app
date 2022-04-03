<template>
  <div class="message self">
    <strong class="user">{{ message.name }}</strong>
    <p id="messageBody" class="body">{{ message.body }}</p>
    <img src="message.attachment" v-if="message.with_attach == true">
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