<template>

  <b-container>
    <b-table striped :fields="fields" :items="items.data"  responsive="lg" >
      <template #cell(more)="data">
        <router-link :to="'email/id/'+data.item.id">see</router-link>
      </template>
    </b-table>

    <pagination :data="items" @pagination-change-page="getResults"></pagination>
  </b-container>
</template>

<script>

import axios from "axios";

export default {
  name: "EmailTable",
  data(){
    return {
     items:{},
      fields: [
        {key:'to',label:'Recipient',headerTitle:'Recipient'},
        {key:'from',label:'Sender',headerTitle:'Sender'},
        {key:'subject',label:'Subject',headerTitle:'Subject'},
        {key:'status',label:'Status',headerTitle:'Status'},
        'more'
      ],
      searchParams:{}
    }
  },
  props: {
    queryParams:Object,
  },
  mounted() {
    this.getResults();
    this.searchParams = this.queryParams;
  },
  methods:{
    getResults(page=1) {


      let params = this.searchParams;
      params["page"] = page

      axios({
        method: "get",
        url: process.env.VUE_APP_API_URL+'/api/email/search',
        params: params,
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem("token"),
        }
      }).then(response => {
        this.setResults(response.data)
      }).catch(function (response) {
        alert('No result found');
        console.log(response);
      })
    },

    setResults(data) {
      this.items = data
    }
  },
  watch: {
    queryParams: function () {
      this.searchParams = this.queryParams;
      this.getResults();
    }
  }
}
</script>

<style scoped>

</style>