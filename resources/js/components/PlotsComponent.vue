<template>
  <div class="container">
    <div class="row justify-content-center">
      <b-card-text>
        <b-form @submit="onSubmit" @reset="onReset">
          <b-form-group
              id="input_cadastral_numbers"
              description="Введите кадастровые номера через запятую. Например, 69:27:0000022:1306,69:27:0000022:1307"
              label="Кадастровые номера"
              label-for="cadastral_numbers"
          >
            <b-form-input
                v-model="form.cadastral_numbers"
                id="cadastral_numbers"
                name="cadastral_numbers"
                type="text"
                required
            >
            </b-form-input>
          </b-form-group>

          <b-button type="submit" variant="primary">Submit</b-button>
          <b-button type="reset" variant="danger">Reset</b-button>
        </b-form>
      </b-card-text>
      <div class="row justify-content-center">
        <b-table striped hover bordered :items="plotsData" :fields="fields">

        </b-table>
      </div>
    </div>
  </div>
</template>

<script>
import {CardPlugin} from 'bootstrap-vue'

export default {
  components: {CardPlugin},
  data() {
    return {
      form: {
        cadastral_numbers: '',
      },
      fields: ['first_name', 'last_name', 'age'],
      plotsData: [
        {age: 40, first_name: 'Dickerson', last_name: 'Macdonald'},
        {age: 21, first_name: 'Larsen', last_name: 'Shaw'},
        {age: 89, first_name: 'Geneva', last_name: 'Wilson'}
      ]
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      console.log(JSON.stringify(this.form))
      axios.get('https://localhost/api/plots/list?cadastral_numbers=69:27:0000022:1306,69:27:0000022:1307', {
        headers: {
          'Accept': 'application/json',
          'Content-type': 'application/json'
        },
      })
          .then(response => (this.plotsData = response))
          .catch((err) => {
            console.log(err);
          })
          .finally(() => {
            this.loading = false;
          });
    },
    onReset(event) {
      event.preventDefault()
      // Reset our form values
      this.form.cadastral_numbers = ''
    }
  }
}
</script>

