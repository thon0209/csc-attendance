<template>
  <div>
    <div class="d-flex justify-content-center row">
      <div class="col-md-6">
        <div class="card text-center">
          <div class="card-header bg-primary text-white">Today Activity</div>
          <div class="card-body">
            <div v-for="activity in activities">
              <h4
                class="card-title"
              >{{activity.activity_name}} - {{activity.semester}} semester (SY: {{activity.school_year}})</h4>
              <p class="card-text">{{activity.activity_date}} @ {{activity.activity_time}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <form @submit.prevent="addAttendance()">
      <div class="d-flex justify-content-center row py-2">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <div class="row">
                <div class="col-sm-6">
                  <label>Student Attendance Log In</label>
                </div>
                <div class="col-sm-6 float-right">
                  <input
                    type="text"
                    v-model="scan"
                    @keyup="scanBarcode()"
                    class="form-control form-control-sm"
                    placeholder="barcode #"
                  >
                </div>
              </div>
            </div>

            <div class="card-body text-center">
              <div v-for="current_activity in activities">
                <input
                  type="text"
                  hidden
                  v-model="attendance.activity_id=current_activity.activity_id"
                >
              </div>
              <div v-for="student in students">
                <input type="text" hidden v-model="attendance.student_no=student.id">
                <input type="text" hidden v-model="getStringNotif.notifyLastName=student.last_name">
                <input type="text" hidden v-model="getStringNotif.notifyID=student.student_id">
                <h3
                  class="card-title"
                >{{student.last_name}}, {{student.first_name}} {{student.middle_name}} ({{student.student_id}})</h3>
                <p class="card-text">{{student.course}} - {{student.year_level}} year</p>
              </div>
              <button type="sumbit" class="btn btn-primary btn-sm py-2">Log In</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      links: [],
      meta: [],
      page: 1,
      per_page: 1,
      students: [],
      activities: [],
      attendances: [],
      errors: [],
      scan: "",
      getStringNotif: {
        notifyLastName: "",
        notifyID: ""
      },
      attendance: {
        activity_id: "",
        student_no: ""
      }
    };
  },
  mounted() {
    //do something after mounting vue instance
    this.loadActivitySetting();
  },
  methods: {
    addAttendance: function() {
      axios
        .post("./attendance", this.attendance)
        .then(response => {
          method: "post";
          this.attendances.push(response.data.attendance);
          new Noty({
            type: "success",
            layout: "topRight",
            text:
              "Thank you " +
              this.getStringNotif.notifyID +
              "-" +
              this.getStringNotif.notifyLastName,
            timeout: 3000
          }).show();
          this.errors = "";
          this.scan = "";
        })
        .catch(response => {
          this.errors = response.response.data.errors;
          new Noty({
            type: "error",
            layout: "topRight",
            text: "Barcode #: " + this.scan + " has already logged in!",
            timeout: 3000
          }).show();
          this.scan = "";
        });
    },
    loadActivitySetting: function() {
      axios.get("./get-activitysettings").then(response => {
        this.activities = response.data.data;
      });
    },
    scanBarcode: function() {
      axios
        .get(
          "./scan-students" +
            "?search=" +
            this.scan +
            "&page=" +
            this.page +
            "&per_page=" +
            this.per_page
        )
        .then(response => {
          this.students = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
        });
    }
  }
};
</script>
