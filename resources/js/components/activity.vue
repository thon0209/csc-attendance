<template>
  <div class="container">
    <!-- Create button -->
    <div class="py-4">
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#exampleModal"
        data-backdrop="static"
        data-keyboard="false"
      >Create New Activity</button>
    </div>

    <!-- Modal -->
    <form @submit.prevent="addActivity">
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Activity Information</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
                @click="cancelEdit"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form row">
                <div class="form-group col-md-4">
                  <label for="exampleFormControlInput1">Activity Date</label>
                  <input
                    type="date"
                    class="form-control"
                    data-date-format="YYYY-MM-DD"
                    v-model="activity.activity_date"
                  >
                  <span
                    class="text-danger"
                    v-for="error in errors.activity_date"
                    :key="error.key"
                  >{{ error }}</span>
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleFormControlInput1">Semester</label>
                  <select class="form-control" v-model="activity.semester">
                    <option
                      v-for="semesterOption in semesterOptions"
                      v-bind:value="semesterOption.value"
                      :key="semesterOption.value"
                    >{{semesterOption.text}}</option>
                  </select>
                  <span
                    class="text-danger"
                    v-for="error in errors.semester"
                    :key="error.key"
                  >{{ error }}</span>
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleFormControlInput1">School Year</label>
                  <select class="form-control" v-model="activity.schoolyear_id">
                    <option value="0" disabled>Select School Year</option>
                    <option
                      v-for="schoolyear in schoolyear"
                      v-bind:value="schoolyear.id"
                      :key="schoolyear.id"
                    >{{ schoolyear.school_year }}</option>
                  </select>
                  <span
                    class="text-danger"
                    v-for="error in errors.schoolyear_id"
                    :key="error.key"
                  >{{ error }}</span>
                </div>
              </div>

              <div class="form row">
                <div class="form-group col-md-4">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Activity Name</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="activity name"
                      v-model="activity.activity_name"
                    >
                    <span
                      class="text-danger"
                      v-for="error in errors.activity_name"
                      :key="error.key"
                    >{{ error }}</span>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Activity Time</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="activity time"
                      v-model="activity.activity_time"
                    >
                    <span
                      class="text-danger"
                      v-for="error in errors.activity_time"
                      :key="error.key"
                    >{{ error }}</span>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Fines</label>
                    <input
                      type="number"
                      class="form-control"
                      placeholder="0.00"
                      min="0"
                      step="0.01"
                      v-model="activity.fines"
                    >
                    <span
                      class="text-danger"
                      v-for="error in errors.fines"
                      :key="error.key"
                    >{{ error }}</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                @click="cancelEdit"
              >Close</button>
              <button type="sumbit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Table -->
    <div class="py-2">
      <div class="row py-2">
        <div class="col-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Show</span>
            </div>
            <input
              @keyup.enter="fetchIndexData()"
              v-model.number="per_page"
              type="text"
              class="text-center"
              style="width:20%;"
            >
            <div class="input-group-prepend">
              <span class="input-group-text">entries</span>
            </div>
          </div>
        </div>
        <div class="col-4"></div>
        <div class="col-4 pull-right">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Search</span>
            </div>
            <input
              @keyup.enter="searchActivity()"
              v-model="search"
              type="text"
              class="form-control"
              placeholder="activity"
            >
          </div>
        </div>
      </div>

      <table class="table table-hover table-sm">
        <thead class="thead-dark">
          <tr>
            <th>id</th>
            <th scope="col">Activity</th>
            <th scope="col">Activity Date Time</th>
            <th scope="col">Fines</th>
            <th scope="col">Semester</th>
            <th scope="col">School Year</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="activity in activities" :key="activity.key">
            <td>{{activity.id}}</td>
            <td>{{activity.activity_name}}</td>
            <td>{{activity.activity_date}} ( {{activity.activity_time}} )</td>
            <td>{{activity.fines}}</td>
            <td>{{activity.semester}}</td>
            <td>{{activity.school_year}}</td>
            <td>
              <button
                type="button"
                class="btn btn-primary"
                @click="editActivity(activity)"
                data-toggle="modal"
                data-target="#exampleModal"
                data-backdrop="static"
                data-keyboard="false"
              >Edit</button>
            </td>
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
</template>
<script>
export default {
  data() {
    return {
      links: [],
      meta: [],
      page: 1,
      per_page: 15,
      edit: false,
      search: "",
      errors: [],
      activities: [],
      schoolyear: [],
      activity: {
        id: "",
        activity_name: "",
        activity_date: "",
        activity_time: "",
        fines: "",
        semester: "",
        schoolyear_id: ""
      },
      semesterOptions: [
        { text: "1st", value: "1st" },
        { text: "2nd", value: "2nd" },
        { text: "3rd", value: "3rd" },
        { text: "Summer", value: "Summer" }
      ]
    };
  }, //end data
  mounted() {
    this.loadActivity();
    this.loadSchoolYear();
  },
  methods: {
    loadSchoolYear() {
      axios.get("./get-schoolyear").then(response => {
        this.schoolyear = response.data.schoolyear;
      });
    },
    loadActivity() {
      axios.get("./activities").then(response => {
        this.activities = response.data.data;
        this.links = response.data.links;
        this.meta = response.data.meta;
      });
    }, //end loadActivity
    searchActivity() {
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
          this.activities = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
        });
    }, //end searchActivity
    fetchIndexData() {
      axios
        .get(
          "./activities" + "?page=" + this.page + "&per_page=" + this.per_page
        )
        .then(response => {
          this.activities = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
        });
    }, //end fetchIndexData
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
          this.activities = response.data.data;
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
          this.activities = response.data.data;
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
          this.activities = response.data.data;
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
          this.activities = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
        });
    }, //end lastPage()
    addActivity() {
      if (this.edit === false) {
        axios
          .post("./activities", this.activity)
          .then(response => {
            method: "post";
            this.activities.push(response.data.data);
            this.activity = {
              activity_name: "",
              activity_date: "",
              activity_time: "",
              fines: "",
              semester: "",
              schoolyear_id: ""
            };
            this.loadActivity();
            this.errors = "";
          })
          .catch(response => {
            this.errors = response.response.data.errors;
          });
      } else {
        axios
          .patch("./activities/" + this.activity.id, this.activity)
          .then(response => {
            method: "put";
            this.activity = {
              activity_name: "",
              activity_date: "",
              activity_time: "",
              fines: "",
              semester: "",
              schoolyear_id: ""
            };
            this.editState = false;
            this.loadActivity();
            this.errors = "";
          })
          .catch(response => {
            this.errors = response.response.data.errors;
          });
      }
    }, //end addActivity
    editActivity(edit) {
      this.edit = true;
      this.activity = edit;
    }, //end editStudent
    cancelEdit() {
      this.edit = false;
      this.errors = "";
      this.loadActivity();
      this.activity = {
        activity_name: "",
        activity_date: "",
        activity_time: "",
        fines: "",
        semester: "",
        schoolyear_id: ""
      };
    } //end of cancelEdit()
  }
};
</script>
<style lang="scss" scoped>
</style>
