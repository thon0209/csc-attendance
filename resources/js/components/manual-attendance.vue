<template>
  <div class="container py-5">
    <div class="card">
      <div class="card-header">Manual Attendance</div>
      <div class="card-body">
        <div class="form row">
          <div class="form-group col-md-6">
            <div class="form-inline py-3">
              <div class="form-group mx-sm-1">
                <input
                  type="text"
                  v-model="searchstudentID"
                  @keyup.enter="searchID()"
                  class="form-control"
                  placeholder="Student ID"
                >
                <button
                  type="sumbit"
                  class="btn btn-primary float-right ml-2"
                  @click="searchID()"
                >Search</button>
              </div>
            </div>
          </div>
        </div>

        <form @submit.prevent="addAttendance()">
          <div class="form row">
            <div class="form-group col-md-12">
              <label for="exampleFormControlInput1">Name / Course Year</label>
              <div v-for="student in students" :key="student.key">
                <input type="text" hidden v-model="attendance.student_no=student.id">
                <input type="text" hidden v-model="getStringNotif.notifyLastName=student.last_name">
                <input type="text" hidden v-model="getStringNotif.notifyID=student.student_id">
                <input
                  type="text"
                  class="form-control"
                  readonly
                  :value="student.last_name +' '+student.first_name +' '+student.middle_name +' ('+student.course +' - '+student.year_level+')' "
                >
              </div>
              <span
                class="text-danger"
                v-for="error in errors.semester"
                :key="error.key"
              >{{ error }}</span>
            </div>
          </div>

          <div v-for="activity in activities">
            <div class="form row">
              <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Activity</label>
                <input type="text" hidden v-model="attendance.activity_id=activity.activity_id">
                <input
                  type="text"
                  class="form-control"
                  readonly
                  :value="activity.activity_name +' - '+ activity.semester"
                >
              </div>
              <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">School Year</label>
                <input type="text" class="form-control" readonly :value="activity.school_year">
              </div>
            </div>
            <div class="form row">
              <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Activity Date Time</label>
                <input
                  type="text"
                  class="form-control"
                  readonly
                  :value="activity.activity_date +' @ '+ activity.activity_time"
                >
              </div>
            </div>
          </div>
          <button type="sumbit" class="btn btn-primary float-right">Log In</button>
        </form>
      </div>
    </div>
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
      searchstudentID: "",
      search: "",
      getStringNotif: {
        notifyLastName: "",
        notifyID: ""
      },
      attendance: {
        activity_id: "",
        student_no: ""
      }
    };
  }, //end data
  mounted() {
    //do something after mounting vue instance
    this.loadActivitySetting();
  }, //end mounted
  methods: {
    loadActivitySetting: function() {
      axios.get("./get-activitysettings").then(response => {
        this.activities = response.data.data;
      });
    }, //end loadActivitySetting
    searchID: function() {
      axios
        .get(
          "./search-idstudents" +
            "?search=" +
            this.searchstudentID +
            "&page=" +
            this.page +
            "&per_page=" +
            this.per_page
        )
        .then(response => {
          this.students = response.data.data;
          this.links = response.data.links;
          //this.meta = response.data.meta;
        });
    },
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
        })
        .catch(response => {
          (this.errors = response.response.data.errors),
            new Noty({
              type: "error",
              layout: "topRight",
              text:
                "Student ID: " +
                this.getStringNotif.notifyID +
                " has already logged in!",
              timeout: 3000
            }).show();
        });
    }
  } //end methods
}; //end export default
</script>
