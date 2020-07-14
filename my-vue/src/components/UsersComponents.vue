<template>

  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">detail</th>
      <th scope="col">
        <p><router-link :to="{ name: 'AddUser' }" class="btn btn-primary">Add new</router-link></p>
      </th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(user, index) in users" :key="index">
      <th scope="row">{{ user.id }}</th>
      <td>{{ user.name }}</td>
      <td>
        <img v-bind:src="user.image" alt="" width="300px">
      </td>
      <td>{{ user.detail }}</td>
      <td>
        
        <router-link :to="{name: 'EditUser', params: { id: user.id }}" class="btn btn-success">Edit</router-link>
          <button class="btn btn-danger" v-on:click="deleteUser(user.id)">Delete</button>
      </td>
    </tr>
  </tbody>
    
</table>
</template>
<script>

export default {
  data: function() {
    return {
      users:[],
    }
  },
  methods :{
   deleteUser:function(id){
    this.$http.delete('http://5d4849902d59e50014f20a3b.mockapi.io/product/' + id, {
                    headers : {
                        'Content-Type' : 'application/json'
                    }
                }).then((response) => {
                    window.location.reload();
                    alert ('Delete User');   
                }, (response) => {
                 
                });
   }
  },
  mounted(){

    var app =  this;
    app.$http.get(this.$apiURI).then(function(resp){
      app.users = resp.data;
    })
    .catch(function(resp){
      alert('Could not load users');
    });
    
  },

  
};
</script>

<style>
</style>