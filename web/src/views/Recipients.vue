<template>
<div>
  <b-container class="pb-2 pt-4 mt-5">
    <div v-if="noRecords" class="text-center">
      <h1>No records</h1>
      <router-link to="/" class="card-link">Go back</router-link>

    </div>
    <div v-else v-for='email in emails' :key='email.id' class="mb-4" >
      <b-card :title="email.subject" :sub-title="'Sender: '+ email.from + ' Recipient: '+email.to">
        <small>Sent: {{email.created_at | humanize}}</small>
        <b-card-text v-text="email.text_content" class="pt-2">
        </b-card-text>
        <b-card-text v-html="email.html_content" class="pt-2">
        </b-card-text>

        <router-link to="/" class="card-link">Go back</router-link>

      </b-card>
  </div>

  </b-container>
</div>
</template>

<script>
import axios from "axios";
import moment from "moment";

export default {
  name: "Recipients",
  data(){
    return{
      emails:{},
      noRecords:true
    }
  },
  created() {
    axios.get(process.env.VUE_APP_API_URL+'/api/email/recipient/' + this.$route.params.recipient, {
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem("token"),
      }
    })
        .then(response => {
          this.emails = response.data.data;
          this.noRecords = false
        });
  },
  filters:{
    humanize(value){
      return moment(value).fromNow();
    }
  }
}
</script>

<style scoped>

</style>