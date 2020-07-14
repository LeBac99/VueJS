<template>
  <div id="create-User">
    <h1>Create User</h1>
    <form v-on:submit.prevent="addUser">
      <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in errors" :key="error">{{ error }}</li>
    </ul>
  </p>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control"
            id="inputPassword"
            value="email@example.com"
            v-model="user.name"
          />
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control"
            id="inputPassword"
            placeholder="detail"
            v-model="user.detail"
          />
        </div>
      </div>
      <div class="form-group">
        <button class="btn btn-primary">Create</button>
        <button class="btn btn-danger"><router-link :to="{ name: 'Users' }" style="color:#fff">Return to Users</router-link></button>
      </div>
    </form>
  </div>
</template>

<script>

export default {
  data() {
    return {
      user: {},
      errors:[]
    };
  },
  methods: {
    addUser: function() {
      // console.log(this.user);
      if (!this.user.name) {
        this.errors.push('Name required.');
      } else {
      let Api = this.$apiURI + 'create';
      // console.log('Api=',Api);
      this.$http.post(Api, this.user, {
                    headers : {
                        'Content-Type' : 'application/json'
                    }
                }).then(
          response => {
             this.$router.back();
          },
          response => {
          this.errors.push('khong them dk');
          }
        );

      }
    }
  },
};
</script>

<style>
</style>