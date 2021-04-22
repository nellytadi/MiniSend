<template>
  <div class="container">

    <div class="table-responsive">
      <b-table striped :fields="fields" :items="items.data" ></b-table>
    </div>


    <pagination :data="items" @pagination-change-page="getResults"></pagination>


  </div>

</template>

<script>
import axios from "axios";

export default {
  name: "EmailTable",
  data() {
    return {
      perPage: 3,
      currentPage: 1,
      fields: ['to', 'from', 'subject','status'],
      items: []
    }
  },
  mounted() {
    this.getResults();

  },
  methods: {
    // Our method to GET results from a Laravel endpoint
    getResults(page = 1) {
      axios.get('http://api.test/api/emails?per_page=50&page=' + page)
          .then(response => {
            this.items = response.data;
          });
    }
  },
  computed: {
    rows() {
      return this.items.length
    }
  }
}
</script>

<style scoped>

</style>