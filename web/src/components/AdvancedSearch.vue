<template>
  <div>
    <b-container>
      <b-card bg-variant="light">
        <b-col lg="12" class="pb-2 pt-4 text-right"><b-button size="md" variant="outline-primary" v-text="'Advanced Search'" v-on:click="show = !show"></b-button></b-col>

        <b-form @submit="onSubmit" @reset="onReset" v-if="show">

      <b-form-group
          id="input-group-1"
          label="Sender"
          label-for="from">
        <b-form-input
            id="for"
            v-model="form.from"
            type="email"
            placeholder="Enter sender's email"
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-2" label="Recipient" label-for="recipient">
        <b-form-input
            id="recipient"
            type="email"
            v-model="form.to"
            placeholder="Enter recipient's email"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="Subject" label-for="subject">
        <b-form-input
            id="subject"
            type="text"
            v-model="form.subject"
            placeholder="Enter email's subject"
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="Status" label-for="status">
        <b-form-select
            id="status"
            v-model="form.status"
            :options="statuses"

        ></b-form-select>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
      </b-card>

    </b-container>

  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AdvancedSearch",

  data() {
    return {
      form: {
        from: '',
        to: '',
        subject: '',
        status: ''
      },
      statuses: null,
      show: false
    }
  },
  mounted () {
    axios.get(process.env.VUE_APP_API_URL+'/email/statuses/')
        .then(response => (this.statuses = response.data))

  },
  methods: {

    onSubmit(event) {
      event.preventDefault()
      const queryParams = {
        'subject': this.form.subject,
        'from': this.form.from,
        'to': this.form.to,
        'status': this.form.status
      };

      this.$emit('setSearchParams',queryParams)

    },
    onReset(event) {
      event.preventDefault()
      // Reset our form values
      this.form.from = ''
      this.form.to = ''
      this.form.subject = ''
      this.form.status = ''
      // Trick to reset/clear native browser form validation state
      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    },

  }
}
</script>
