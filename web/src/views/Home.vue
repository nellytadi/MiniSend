<template>
  <div id="app">
    <Navigation></Navigation>
    <advanced-search v-on:setSearchParams="setParams"></advanced-search>
    <email-table :queryParams="queryParams" ></email-table>
  </div>
</template>

<script>
import EmailTable from "../components/EmailTable";
import AdvancedSearch from "../components/AdvancedSearch";
import Navigation from "../components/Navigation";

export default {
  name: "Home",
  components: {
    EmailTable,
    AdvancedSearch,
    Navigation
  },
  data(){
    return{
      queryParams:{}
    }
  },
  methods:{
    setParams(data){
      // console.log(data)
       this.queryParams = data;
    }
  },

}
</script>

<style scoped>

</style>