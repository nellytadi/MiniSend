<template>
  <div>
    <b-container class="mt-4">
      <b-alert v-model="showDismissibleAlert" variant="success" dismissible>
        Your email has been stored successfully !!
      </b-alert>
    <b-form @submit="onSubmit" @reset="onReset">
      <b-form-group
          id="input-group-1"
          label="Recipient"
          label-for="to">
        <b-form-input
            id="to"
            v-model="form.to"
            type="email"
            placeholder="Enter email"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group
          id="input-group-1"
          label="Sender"
          label-for="from">
        <b-form-input
            id="from"
            v-model="form.from"
            type="email"
            placeholder="Enter email"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group
          id="input-group-1"
          label="Subject"
          label-for="subject">
        <b-form-input
            id="subject"
            v-model="form.subject"
            type="text"
            placeholder="Enter Subject"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group
          id="input-group-1"
          label="Text Content"
          label-for="text_content">
      <b-form-textarea
          id="text_content"
          v-model="form.text_content"
          placeholder="Type email..."
          rows="3"
          max-rows="6"
      ></b-form-textarea>
      </b-form-group>

      <b-form-file
          v-model="form.attachments"
          :state="Boolean(form.attachments)"
          placeholder="Add attachments"
          drop-placeholder="Drop file here..."
          multiple
      ></b-form-file>
      <div class="mt-3">Selected file: {{ form.attachments ? form.attachments.name : '' }}</div>


      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>

    </b-container>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Create",
  data() {
    return {
      form: {
        to: '',
        from: '',
        subject: '',
        text_content: '',
        attachments: null,
      },
      showDismissibleAlert: false
    }
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();

      let formData = new FormData();

      formData.append( 'to',this.form.to);
      formData.append( 'from',this.form.from);
      formData.append( 'subject',this.form.subject);
      formData.append( 'text_content',this.form.text_content);
      formData.append( 'html_content',this.form.text_content);

      for( let i = 0; i < this.form.attachments.length; i++ ){

        let file = this.form.attachments[i];
        formData.append('attachments[' + i + ']', file);

      }

      axios({
        method: "post",
        url: process.env.VUE_APP_API_URL+'/email/store',
        data: formData,
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(response => {

        console.log(response.data)

        this.showDismissibleAlert=true
        this.onReset(event)

      }).catch(function (response) {
        console.log(response);
      })
    },
    onReset(event) {
      event.preventDefault()
      // Reset our form values
      this.form.to = ''
      this.form.from = ''
      this.form.subject = ''
      this.form.text_content = ''
      this.form.attachments = null

    }
  }
}
</script>