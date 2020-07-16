<template>
  <table class="table table-striped">
    <div class="search">
      <nav class="navbar navbar-light bg-light">
        <input
          class="form-control mr-sm-2"
          type="search"
          placeholder="Search"
          aria-label="Search"
          v-model="key"
          @keyup = "search"
        />
      </nav>
    </div>
    <thead v-if="users">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>

        <th scope="col">Email</th>
        <th scope="col">Permission</th>
        <th scope="col">
          <p>
            <router-link :to="{ name: 'AddUser' }" class="btn btn-primary">Add new</router-link>
          </p>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(user, index) in users" :key="index">
        <!-- <th scope="row">{{ user.id }}</th> -->
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>
          <p v-if="user.role_id == 5">Admin</p>
          <p v-else>Member</p>
        </td>
        <td>
          <router-link :to="{name: 'AddUser', params: { id: user.id }}" class="btn btn-success">Edit</router-link>
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
      users: [],
      key: ""
    };
  },
  methods: {
    deleteUser: function(id) {
      //  console.log(id);
      this.$confirm({
        message: `Are you delete user?`,
        button: {
          no: "No",
          yes: "Yes"
        },
        /**
         * Callback Function
         * @param {Boolean} confirm
         */
        callback: confirm => {
          if (confirm) {
            let app = this;
            app.axios.delete(app.$apiURI + "delete-user/" + id).then(resp => {
              window.location.reload();
            });
          }
        }
      });
    },
    search: function() {
    console.log(this.key, 'keeeeyey');
    var that = this;
    this.axios
      .get(that.$apiURI + 'search/' + that.key)
      .then(function(resp) {
        console.log(resp.data, 6666666666, 'dddd', typeof resp.data);
          that.users = resp.data;
          console.log('fffffff', that.users);

      });
    }
  },
  mounted() {
    var app = this;
    app.axios
      .get(this.$apiURI)
      .then(function(resp) {
        app.users = resp.data;
      })
      .catch(function(resp) {
        alert("Could not load users");
      });
  }
};
</script>

<style>
</style>