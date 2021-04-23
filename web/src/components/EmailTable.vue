<template>

  <b-container>
    <b-table striped :fields="fields" :items="items.data"  responsive="lg" >
      <template #cell(more)="data">
        <router-link :to="'email/'+data.item.id">see</router-link>
      </template>
    </b-table>

    <pagination :data="items" @pagination-change-page="getResults"></pagination>
  </b-container>
</template>

<script>

import EmailPaginator from "./EmailPaginator";
import axios from "axios";

export default {
  name: "EmailTable",
  components: {EmailPaginator},
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
      params:{}

    }
  },
  props: {
    results:Object,
    formData:Object,
  },
  mounted() {
    this.items = this.results;
    this.params = this.formData;
    console.log(this.params);

  },
  methods:{
    getResults(page=1) {

      let params = this.formData
      console.log(params);

      axios({
        method: "get",
        url: 'http://api.test/api/email/search',
        params: params,
      }).then(response => {
        this.setResults(response.data)
      }).catch(function (response) {
        console.log(response);
      })

    },

    setResults(data) {
      this.items = data
    }
  },
  watch: {
    results: function () {
      this.items = this.results;
    },
    formData: function () {
      this.params = this.formData;
    }
  }
}
</script>

<style scoped>

</style>