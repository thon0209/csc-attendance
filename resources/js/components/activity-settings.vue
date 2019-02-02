<template>
  <div class="container py-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Set Activity</h5>

        <div v-for="setting in settings">
          <p class="card-text">Current Activity: {{setting.activity_name}}</p>
        </div>

        <form @submit.prevent="updateSetting">
          <div class="row py-4">
            <div class="col-md-12">
              <label>Activity</label>
              <select class="form-control" v-model="setting.activity_id">
                <option value="0" disabled>Select Activity</option>
                <option
                  v-for="activity in activities"
                  v-bind:value="activity.id"
                  :key="activity.id"
                >{{ activity.activity_name }}</option>
              </select>
              <span
                class="text-danger"
                v-for="error in errors.activity_id"
                :key="error.key"
              >{{ error }}</span>
            </div>
          </div>
          <div class="py-4">
            <button type="sumbit" class="btn btn-primary float-right">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      activities: [],
      settings: [],
      errors: [],
      setting: {
        id: 1,
        activity_id: ""
      }
    };
  }, //end data
  mounted() {
    //do something after mounting vue instance
    this.loadActivity();

    this.loadSetting();
  },
  methods: {
    loadActivity() {
      axios.get("./get-activity").then(response => {
        this.activities = response.data.activities;
      });
    },

    loadSetting() {
      axios.get("./activity-settings").then(response => {
        this.settings = response.data.data;
      });
    },
    updateSetting() {
      axios
        .patch("./activity-settings/" + this.setting.id, this.setting)
        .then(response => {
          method: "put";
          this.setting = {
            id: 1,
            activity_id: "",
            schoolyear_id: ""
          };
          this.loadSetting();
          this.errors = "";
        })
        .catch(response => {
          this.errors = response.response.data.errors;
        });
    }
  }
};
</script>
