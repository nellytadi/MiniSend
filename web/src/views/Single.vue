<template>
  <div>

    <b-container class="pb-2 pt-4 mt-5">

      <b-card :title="email.subject" :sub-title="'Sender: '+ email.from + ' Recipient: '+email.to">
        <small>Sent: {{email.created_at | humanize}}</small>
        <b-card-text v-text="email.text_content" class="pt-2">
        </b-card-text>
        <b-card-text v-html="email.html_content" class="pt-2">
        </b-card-text>
        <div v-if="email.attachments.length>0">
          <span>Attachments</span>
          <div v-for="attachment in email.attachments" :key="attachment.attachment">
            <a :href="url+'/'+attachment.attachment" target="_blank">{{attachment.attachment}}</a>
          </div>
        </div>

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
      email:{},
      url:''
    }
  },
  created() {
    this.url = process.env.VUE_APP_LOCAL_FILE_URL
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