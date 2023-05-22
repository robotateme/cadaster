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
                :state="validationState.cadastral_numbers_state"
                required
            >
            </b-form-input>
            <b-form-invalid-feedback>
              {{errors.cadastral_numbers}}
            </b-form-invalid-feedback>
          </b-form-group>

          <b-button type="submit" variant="primary">Submit</b-button>
          <b-button type="reset" variant="danger">Reset</b-button>
        </b-form>
      </b-card-text>
      <div class="row justify-content-center">
        <b-table striped hover bordered :items="plotsData" :fields="fields"></b-table>
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
      validationState: {
        cadastral_numbers_state: null
      },
      form: {
        cadastral_numbers: '69:27:0000022:1306, 69:27:0000022:1307',
      },
      fields: [
        {
          key: 'cadastral_number',
          label: 'CN',
        },
        {
          key: 'address',
          label: 'Address'
        },
        {
          key: 'area',
          label: 'Area'
        },
        {
          key: 'price',
          label: 'Price'
        }],
      plotsData: [],
      errors: {
        cadastral_numbers: 'Empty',
      },
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      console.log(JSON.stringify(this.form))
      axios.get('http://localhost/api/plots/list', {
        params: this.form,
        withCredentials: false,
        headers: {
          'Accept': 'application/json',
          'Content-type': 'application/json'
        },
      })
          .then((response) => {
            this.validationState.cadastral_numbers_state = true;
            this.plotsData = response.data?.plots;
          })
          .catch((err) => {
            if(err.response.status === 422) {
                this.errors = err.response.data.errors;
                this.validationState.cadastral_numbers_state = false
            }
          })
          .finally(() => {
          });
    },
    onReset(event) {
      event.preventDefault()
      // Reset our form values
      this.form.cadastral_numbers = '';
    }
  }
}
</script>

