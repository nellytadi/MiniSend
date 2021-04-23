<template>
  <div id="app">
    <Navigation></Navigation>
    <advanced-search></advanced-search>
    <email-table v-if="hasLoaded" :results="results" :url="url"></email-table>
  </div>
</template>

<script>
import EmailTable from "../components/EmailTable";
import AdvancedSearch from "../components/AdvancedSearch";
import Navigation from "../components/Navigation";
import axios from "axios";


export default {
  name: "Home",
  components: {
    EmailTable,
    AdvancedSearch,
    Navigation
  },
  data(){
    return{
      results:null,
      perPage:100,
      currentPage:1,
      hasLoaded:false,
      url:''
    }
  },
  created(){
    this.url='http://api.test/api/emails'

    axios.get(this.url+'?per_page='+this.perPage)
        .then(response => {

          this.setResults(response.data)

        });
  },
  methods:{
    setResults(data) {

        this.results = data;
        this.hasLoaded=true
    }
  },
}
</script>

<style scoped>

</style>