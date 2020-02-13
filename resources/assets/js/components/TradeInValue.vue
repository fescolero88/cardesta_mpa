<template>

<div class="modal detail-modal valueyourtrade-modal fade" id="valueyourtradeModalLong" tabindex="-1" role="dialog" aria-labelledby="valueyourtradeModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="valueyourtradeModalLongTitle">Value Trade-in</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="valueyourtrade">
            <h3 class="mb-3 mt-4 ">Contact Information</h3>
            <form @submit.prevent="submit">
                <div class="callout">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customerfirstname">First Name:<small> required</small> </label>
                            <input type="text" class="form-control" id="customerfirstname" placeholder="">
                            <div v-if="errors && errors.firstname" class="text-danger">{{ errors.firstname[0] }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="customerlastname">Last Name: <small> required</small></label>
                            <input type="text" class="form-control" id="customerlastname" placeholder="">
                            <div v-if="errors && errors.lastname" class="text-danger">{{ errors.lastname[0] }}</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customeremail">Email Address:<small> required</small> </label>
                            <input type="email" class="form-control" id="customeremail" placeholder="">
                            <div v-if="errors && errors.customeremail" class="text-danger">{{ errors.customeremail[0] }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="customerphone">Phone Number:  <small> required</small></label>
                            <input type="tel" class="form-control" id="customerphone" placeholder="">
                            <div v-if="errors && errors.customerphone" class="text-danger">{{ errors.customerphone[0] }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comments1">Comments:</label>
                        <textarea name="comments1" rows="4" class="form-control" data-value=""></textarea>
                        <div v-if="errors && errors.comments1" class="text-danger">{{ errors.comments1[0] }}</div>
                    </div>
                </div>
                <h3 class="mb-3 mt-4 ">Vehicle Information</h3>
                <div class="callout">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="vehicle-year">Year</label>
                            <input type="text" class="form-control" id="vehicle-year" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="vehicle-make">Make</label>
                            <input type="text" class="form-control" id="vehicle-make" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="vehicle-model">Model</label>
                            <input type="text" class="form-control" id="vehicle-model" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="vehicle-trim">Trim</label>
                            <input type="text" class="form-control" id="vehicle-trim" placeholder="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="vehicle-mileage">Mileage</label>
                            <input type="text" class="form-control" id="vehicle-mileage" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <p>By submitting this form, you will be requesting trade-in value at no obligation and will be contacted within 48 hours by a sales representative.</p>
                        <button type="submit" class="btn big-btn btn-gradient blue-gradient-bg">Submit</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
name : 'tradeInValue',
  data() {
    return {
      fields: {},
      errors: {},
      success: false,
      loaded: true,
    }
  },
  methods: {
    submit() {
      if (this.loaded) {
        this.loaded = false;
        this.success = false;
        this.errors = {};
        axios.post('/frontend/get-trading-value', this.fields).then(response => {
          this.fields = {}; //Clear input fields.
          this.loaded = true;
          this.success = true;
        }).catch(error => {
          this.loaded = true;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        });
      }
    },
  },
}
</script>
