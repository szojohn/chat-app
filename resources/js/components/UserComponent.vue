<template>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Users</div>
            <div class="card-body">
                <div class="users" v-for="user in users" :key="user.id">
                    <a href=#>{{ user.name }} </a>
                </div>
                <div>
                    <strong>Where names should be</strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Event from '../events.js';
    const { io } = require("socket.io-client")
    export default {
        data() {
            return {
                users: [],
                user: Laravel.user,
            }
        },
        // beforeMount() {
        //     this.socketInstance = io("http://localhost:3000");
        //     // this.name = Laravel.user.name;
        //     this.socketInstance.emit('login', this.user);
        //     this.socketInstance.on('getUsers', (data) => {
        //         this.users.concat(data);
        //         console.log(this.users);
        //     })
        // },
        // methods:{
        //     updateUsers() {
        //         return this.users
        //     }
        // }
    }
</script>

<style>
    .users {
        background-color: #fff;
        border-radius: 3px;
    }
</style>