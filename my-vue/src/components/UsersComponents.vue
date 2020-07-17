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
          v-on:change="search"
        />
      </nav>
    </div>
    <thead>
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
      <tr v-for="user in users" :key="user.id">
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
      <div class="alert alert-errors" v-if="errors">
        <strong>Danger!</strong>
        {{errors}}.
      </div>
    </tbody>
    <!-- credits -->
    <div class="card-footer pb-0 pt-3">
      <jw-pagination :items="users" @changePage="onChangePage"></jw-pagination>
    </div>
  </table>
</template>
<script>
export default {
  data: function() {
    return {
      users: [],
      key: "",
      errors: ""
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
      var that = this;
      if(that.key == ''){
           window.location.reload();
      }
      this.axios
        .get(that.$apiURI + "search/" + that.key)
        .then(function(resp) {
          that.users = Array.from(resp.data);
          that.errors = resp.data.MESSAGE;
          console.log("111", that.errors);
        })
        .catch(error => {
            // this.users = error.response.data;   
        });
    },
    onChangePage(pageOfItems) {
      // update page of items
      console.log('bac',pageOfItems);
      // this.users = pageOfItems;
    }
  },
  mounted() {
    this.axios
      .get(this.$apiURI)
      .then(resp => {
        this.users = resp.data;
      })
      .catch(function(resp) {
        alert("Could not load users");
      });
    }
};
</script>

<style>
a {
  cursor: pointer;
}
.pagination {
  justify-content: center;
  flex-wrap: wrap;
}
</style>