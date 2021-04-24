<template>
  <div>

    <b-container v-model="email" class="pb-2 pt-4 mt-5">

      <b-card :title="email.subject" :sub-title="'Sender: '+ email.from + ' Recipient: '+email.to">
        <small>Sent: {{email.created_at | humanize}}</small>
        <b-card-text v-text="email.text_content" class="pt-2">
        </b-card-text>
        <b-card-text v-html="email.html_content" class="pt-2">
        </b-card-text>


        <router-link to="/" class="card-link">Go back</router-link>

      </b-card>
    </b-container>
  </div>
</template>

<script>
import moment from "moment";
import axios from "axios";

export default {
  name: "Single",
  data(){
    return{
      email:{}
    }
  },
  created() {
    axios.get(process.env.VUE_APP_API_URL+'/email/id/' + this.$route.params.id).then(response => this.email = response.data.data)
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