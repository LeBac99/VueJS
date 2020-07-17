<template>
  <div id="create-User">
    <div class="bar">
      <p>Add-user</p>
    </div>
    <form v-on:submit.prevent="addUser">
      <div class="error" v-if="errors">
        <span class="alert alert-danger" v-for="(err, index) in errors" :key="index">{{ err[0] }}</span>
        <hr />
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input
          type="text"
          class="form-control"
          id="exampleInputEmail1"
          v-model="user.name"
          aria-describedby="emailHelp"
          placeholder="Enter name"
        />
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input
          type="text"
          class="form-control"
          id="exampleInputEmail1"
          v-model="user.email"
          aria-describedby="emailHelp"
          placeholder="Enter email"
        />
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input
          type="password"
          class="form-control"
          id="exampleInputPassword1"
          v-model="user.password"
          placeholder="Password"
        />
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Permission</label>
        <select
          class="form-control"
          v-model="user.role_id"
          id="exampleFormControlSelect1"
          aria-placeholder="Permission"
        >
          <option value="1">Member</option>
          <option value="5">Admin</option>
        </select>
      </div>
      <div class="form-group">
        <button class="btn btn-primary">Create</button>
        <router-link
          :to="{ name: 'Users' }"
          class="btn btn-danger"
          style="color:#fff"
        >Return to Users</router-link>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {},
      errors: {}
    };
  },
  created: function() {
    this.getUser();
  },
  methods: {
    getUser: function() {
      if (this.$route.params.id) {
        let Api = this.$apiURI;
        this.axios.get(Api + this.$route.params.id).then(response => {
          this.user = response.data;
          console.log(this.user);
        });
      } else {
        //  this.user = null;
      }
    },
    addUser: function() {
      // console.log(this.user);
      if (this.$route.params.id) {
        let Api = this.$apiURI;
        this.axios
          .put(Api + this.$route.params.id, this.user)
          .then(response => {
            this.$router.back();
          })
          .catch(error => {
            this.errors = error.response.data;
          });
      } else {
        let Api = this.$apiURI + "add-user";
        this.axios
          .post(Api, this.user)
          .then(response => {
            this.$router.back();
          })
          .catch(error => {
            this.errors = error.response.data;
          });
      }
    }
  }
};
</script>

<style>
.bar {
  width: 100%;
  height: 30px;
  border: 1px solid black;
  font-size: 20px;
  color: darkgreen;
  background-color: darkgrey;
}
form {
  margin-top: 20px;
}
</style>