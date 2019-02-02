<template>
  <div class="container py-5">
    <div class="card">
      <div class="card-header">Atendance List</div>
      <div class="card-body">
        <div class="form-inline py-3">
          <div class="form-group mx-sm-1">
            <input type="text" class="form-control" placeholder="student id #" v-model="search">
          </div>
          <button
            type="sumbit"
            class="btn btn-primary float-right"
            @click="searchAttendance()"
          >Search</button>
        </div>

        <table class="table table-sm table-hover">
          <thead>
            <tr>
              <th scope="col">Student ID</th>
              <th scope="col">Last Name</th>
              <th scope="col">Activity</th>
              <th scope="col">Date Time Log</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="attendance in attendances" :key="attendance.key">
              <td>{{attendance.student_id}}</td>
              <td>{{attendance.last_name}}</td>
              <td>{{attendance.activity_name}} - {{attendance.semester}} semester (SY: {{attendance.school_year}})</td>
              <td>{{attendance.time_log}}</td>
            </tr>
          </tbody>
        </table>

        <div class="float-left">
          <label>Showing {{ meta.current_page }} to {{ meta.last_page }} of {{ meta.total }} entries</label>
        </div>
        <div class="float-right">
          <ul class="pagination">
            <li>
              <button
                type="button"
                class="btn btn-default"
                @click="firstPage"
                :disabled="!this.links.first"
              >&laquo;</button>
            </li>
            <li>
              <button
                type="button"
                class="btn btn-default"
                @click="prevPage"
                :disabled="!this.links.prev"
              >Previous</button>
            </li>
            <li>
              <button
                type="button"
                class="btn btn-default"
                @click="nextPage"
                :disabled="!this.links.next"
              >Next</button>
            </li>
            <li>
              <button
                type="button"
                class="btn btn-default"
                @click="lastPage"
                :disabled="!this.links.last"
              >&raquo;</button>
            </li>
          </ul>
        </div>
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
      attendances: [],
      search: ""
    };
  }, //end data
  mounted() {
    //do something after mounting vue instance
    this.loadAttendance();
  }, //end mounted
  methods: {
    loadAttendance: function() {
      axios.get("./attendance").then(response => {
        this.attendances = response.data.data;
        this.links = response.data.links;
        this.meta = response.data.meta;
      });
    },
    searchAttendance: function() {
      axios
        .get(
          this.meta.path +
            "?search=" +
            this.search +
            "&page=" +
            this.page +
            "&per_page=" +
            this.per_page
        )
        .then(response => {
          this.attendances = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
        });
    }, //end searchActivity
    prevPage() {
      axios
        .get(
          this.links.prev +
            "&per_page=" +
            this.per_page +
            "&search=" +
            this.search
        )
        .then(response => {
          this.attendances = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
        });
    }, //end of  prevPage()
    nextPage() {
      axios
        .get(
          this.links.next +
            "&per_page=" +
            this.per_page +
            "&search=" +
            this.search
        )
        .then(response => {
          this.attendances = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
        });
    }, //end of nextPage()
    firstPage() {
      axios
        .get(
          this.links.first +
            "&per_page=" +
            this.per_page +
            "&search=" +
            this.search
        )
        .then(response => {
          this.attendances = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
        });
    }, //end firstPage()
    lastPage() {
      axios
        .get(
          this.links.last +
            "&per_page=" +
            this.per_page +
            "&search=" +
            this.search
        )
        .then(response => {
          this.attendances = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
        });
    } //end lastPage()
  } //end methods
}; //end export default
</script>

