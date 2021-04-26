<template>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <router-link to="/" ><b-navbar-brand>MiniSend</b-navbar-brand></router-link>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">

          <b-nav-item class="mr-3">
            <router-link to="/create" style="color: #fff">Create Email</router-link>
          </b-nav-item>

        <b-nav-form @submit="onSubmit">
          <b-form-input size="sm" class="mr-sm-2" v-model="search" placeholder="Search Recipients" type="email"></b-form-input>
          <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
        </b-nav-form>
        <a class=" text-white  text-sm "
            @click="logout"
        >Logout</a>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item class="mr-3">
          <router-link to="/login" style="color: #fff">Login</router-link>
        </b-nav-item>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>

</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "Navigation",
  data(){
    return{
      search:''
    }
  },
  computed: {
    ...mapGetters("auth", ["loggedIn"])
  },
  methods:{
    onSubmit(event) {
      event.preventDefault();
      this.$router.push({ name: 'recipients', params: { recipient: this.search } })
    },
    logout() {
      this.$store.dispatch("auth/logout");
    }
  },



}
</script>

<style scoped>

</style>