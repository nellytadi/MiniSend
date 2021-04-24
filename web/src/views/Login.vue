<template>
  <div>
    <b-container class="mt-5">
      <h1 class="text-center">Login</h1>
    <b-form @submit="onSubmit">
      <b-form-group
          id="input-group-1"
          label="Email address:"
          label-for="input-1"

      >
        <b-form-input
            id="input-1"
            v-model="form.email"
            type="email"
            placeholder="Enter email"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group
          id="input-group-1"
          label="Password:"
          label-for="password"
      >
        <b-form-input
            id="password"
            v-model="form.password"
            type="password"
            placeholder="Enter Password"
            required
        ></b-form-input>
      </b-form-group>
      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>
    </b-container>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name:'Login',
  data() {
    return {
      form: {
        email: '',
        password: '',

      },
    }
  },
  methods: {
    onSubmit(event) {
      event.preventDefault()
      axios({
        method: "post",
        url: process.env.VUE_APP_API_URL+'/login',
        data: {
          'email':this.form.email,
          'password':this.form.password
        },
      }).then(response => {
        console.log(response.data)

      }).catch(function (response) {
        console.log(response);
      })
    },

  }
}
</script>