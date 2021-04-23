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

    }
  },
  props: {
    results:Object,
    url:String
  },
  mounted() {
    this.items = this.results;
  },
  methods:{
    getResults(page=1) {
      let url = this.url

      axios.get(url+'?page=' + page)
          .then(response => {
            this.items = response.data;
          });
    }
  }


}
</script>

<style scoped>

</style>