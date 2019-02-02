<template>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="card" style="max-width: 20rem;">
          <div class="card-header bg-primary text-white">Student Information</div>
          <div class="card-body">
            <label class="mb-0">Student ID</label>
            <div class="input-group">
              <input type="text" v-model="search" class="form-control">
              <div class="input-group-append">
                <button type="button" class="btn btn-primary" @click="searchStudent()">Search ID</button>
              </div>
            </div>

            <div v-for="student in students">
              <input type="text" hidden v-model="summaryInfo.id=student.id">
              <label class="mb-0">Last Name</label>
              <input type="text" class="form-control" readonly :value="student.last_name">
              <label class="mb-0">First Name</label>
              <input type="text" class="form-control" readonly :value="student.first_name">
              <label class="mb-0">Middle Name</label>
              <input type="text" class="form-control" readonly :value="student.middle_name">
              <label class="mb-0">Course Year</label>
              <input
                type="text"
                class="form-control"
                readonly
                :value="student.course + '-' +student.year_level"
              >
            </div>

            <div class="form row">
              <div class="form-group col-md-6">
                <label class="mb-0">School Year</label>
                <select class="form-control" v-model="summaryInfo.schoolyear_id">
                  <option
                    v-for="schoolyear in schoolyear"
                    v-bind:value="schoolyear.id"
                    :key="schoolyear.id"
                  >{{ schoolyear.school_year }}</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label class="mb-0">Semester</label>
                <select class="form-control" v-model="summaryInfo.semester">
                  <option
                    v-for="semesterOption in semesterOptions"
                    v-bind:value="semesterOption.value"
                  >{{semesterOption.text}}</option>
                </select>
              </div>
            </div>
            <button class="btn btn-primary float-right" @click="searchSummary()">GO</button>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="col">
          <div class="card" style="max-width: 50rem;">
            <div class="card-header bg-primary text-white">Attendance Absences</div>
            <div class="card-body p-0">
              <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                  <tr>
                    <th scope="col" width="5%">No.</th>
                    <th scope="col" width="50%">Activity</th>
                    <th scope="col" width="30%">Date</th>
                    <th scope="col">Fines</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(summary,item) in Attendancesummaries" :key="summary.item">
                    <td>{{ item + 1 }}</td>
                    <td>{{ summary.activity_name }}</td>
                    <td>{{ summary.activity_date }}</td>
                    <td>{{ summary.fines | currency('₽', 2, { symbolOnLeft: true, spaceBetweenAmountAndSymbol: true }) }}</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3">
                      <div style="float:right;">Total Fines:</div>
                    </td>
                    <td>
                      <strong>{{ total | currency('₽', 2, { symbolOnLeft: true, spaceBetweenAmountAndSymbol: true }) }}</strong>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Vue2Filters from "vue2-filters";
export default {
  data() {
    return {
      links: [],
      meta: [],
      page: 1,
      per_page: 50,
      search: "",
      search_semester: "",
      search_sy: "",
      students: [],
      activities: [],
      schoolyear: [],
      Attendancesummaries: [],
      summaryInfo: {
        id: "",
        schoolyear_id: "",
        semester: ""
      },
      semesterOptions: [
        { text: "1st", value: "1st" },
        { text: "2nd", value: "2nd" },
        { text: "3rd", value: "3rd" },
        { text: "Summer", value: "Summer" }
      ]
    };
  },
  computed: {
    total() {
      return this.Attendancesummaries.reduce((acc, summary) => {
        return acc + summary.fines;
      }, 0);
    }
  },
  mounted() {
    //do something after mounting vue instance
    this.loadSchoolYear();
  },
  methods: {
    searchSummary() {
      axios
        .get(
          "./summary-attendance" +
            "?q=" +
            this.summaryInfo.id +
            "&schoolyear=" +
            this.summaryInfo.schoolyear_id +
            "&semester=" +
            this.summaryInfo.semester
        )
        .then(response => {
          this.Attendancesummaries = response.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
        });
    },
    searchStudent() {
      axios
        .get("./search-idstudents" + "?search=" + this.search)
        .then(response => {
          this.students = response.data.data;
        });
    },
    loadSchoolYear() {
      axios.get("./get-schoolyear").then(response => {
        this.schoolyear = response.data.schoolyear;
      });
    }
  }
};
</script>
<style lang="scss" scoped>
</style>
