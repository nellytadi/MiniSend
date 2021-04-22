<template>
  <div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
          id="input-group-1"
          label="Sender"
          label-for="for">
        <b-form-input
            id="for"
            v-model="form.for"
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
            required
        ></b-form-select>
      </b-form-group>



      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card>
  </div>
</template>

<script>
export default {
  name: "AdvancedSearch",

  data() {
    return {
      form: {
        email: '',
        name: '',
        food: null,
        checked: []
      },
      foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
      show: true
    }
  },
  methods: {
    onSubmit(event) {
      event.preventDefault()
      alert(JSON.stringify(this.form))
    },
    onReset(event) {
      event.preventDefault()
      // Reset our form values
      this.form.email = ''
      this.form.name = ''
      this.form.food = null
      this.form.checked = []
      // Trick to reset/clear native browser form validation state
      this.show = false
      this.$nextTick(() => {
        this.show = true
      })
    }
  }
}
</script>
