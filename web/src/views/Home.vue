<template>
  <div>
    <advanced-search v-on:setSearchParams="setParams"></advanced-search>
    <email-table :queryParams="queryParams" ></email-table>
  </div>
</template>

<script>
import EmailTable from "../components/EmailTable";
import AdvancedSearch from "../components/AdvancedSearch";

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