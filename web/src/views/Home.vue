<template>
  <div>
    <advanced-search v-on:setSearchParams="setParams"></advanced-search>
    <email-table :queryParams="queryParams" ></email-table>
  </div>
</template>

<script>
import EmailTable from "../components/EmailTable";
import AdvancedSearch from "../components/AdvancedSearch";
import { mapGetters } from "vuex";
export default {
  name: "Home",
  components: {
    EmailTable,
    AdvancedSearch,

  },
  data(){
    return{
      queryParams:{}
    }
  },
  computed: {
    ...mapGetters("auth", ["authUser", "loggedIn"])
  },
  methods: {
    setParams(data){
      // console.log(data)
      this.queryParams = data;
    },
    logout() {
      this.$store.dispatch("auth/logout");
    }
  }

}
</script>

<style scoped>

</style>