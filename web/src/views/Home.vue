<template>
  <div id="app">
    <Navigation></Navigation>
    <advanced-search v-on:setSearchResults="setResults" v-on:setFormData="setForm"></advanced-search>
    <email-table v-if="hasLoaded" :results="results" ></email-table>
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
      hasLoaded:false,
      formData:{}
    }
  },
  created(){
    axios.get('http://api.test/api/email/search?per_page='+this.perPage)
        .then(response => {
          this.setResults(response.data)
        });
  },
  methods:{

    setResults(data) {
        this.results = data;
        this.hasLoaded=true
    },

    setForm(data){

       this.formData = data;
    }
  },

}
</script>

<style scoped>

</style>