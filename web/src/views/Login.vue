<template>
  <div>
    <b-container class="mt-5">
      <h1 class="text-center">Login</h1>
    <b-form @submit.prevent="login">
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
import { mapGetters } from "vuex";
export default {
  name:'Login',
  data() {
    return {
      form: {
        email: 'test@minisender.com',
        password: 'password',

      },
    }
  },
  computed: {
    ...mapGetters("auth", ["authUser", "error", "loading"]),
  },
  methods: {
    login() {
      this.$store.dispatch("auth/login", this.form).then(() => {
        this.$router.push(this.$route.query.redirect || "/");
      });
    },
  },

  }

</script>