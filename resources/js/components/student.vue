<template>
  <div class="container">
    <!-- Create button -->
    <div class="py-4">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">Create New Student</button>
    </div>

    <!-- Modal -->
    <form @submit.prevent="addStudent">
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Student Information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cancelEdit">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form row">
                <div class="form-group col-md-4">
                  <label for="exampleFormControlInput1">Student ID</label>
                  <input type="text" class="form-control" v-model="student.student_id" placeholder="student id">
                  <span class="text-danger" v-for="error in errors.student_id" :key="error.key">{{ error }}</span>
                </div>
              </div>

              <div class="form row">
                <div class="form-group col-md-4">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Last Name</label>
                    <input type="text" class="form-control" v-model="student.last_name" placeholder="last name">
                    <span class="text-danger" v-for="error in errors.last_name" :key="error.key">{{ error }}</span>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">First Name</label>
                    <input type="text" class="form-control" v-model="student.first_name" placeholder="first name">
                    <span class="text-danger" v-for="error in errors.first_name" :key="error.key">{{ error }}</span>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Middle Name</label>
                    <input type="text" class="form-control" v-model="student.middle_name" placeholder="middle name">
                    <span class="text-danger" v-for="error in errors.middle_name" :key="error.key">{{ error }}</span>
                  </div>
                </div>
              </div>

              <div class="form row">
                <div class="form-group col-md-4">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Course</label>
                    <select v-model="student.course" class="form-control">
                      <option v-for="courseOption in courseOptions" v-bind:value="courseOption.value">
                        {{courseOption.text}}
                      </option>
                    </select>
                    <span class="text-danger" v-for="error in errors.course" :key="error.key">{{ error }}</span>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Year Level</label>
                    <select v-model="student.year_level" class="form-control">
                      <option v-for="yearlevelOption in yearlevelOptions" v-bind:value="yearlevelOption.value">
                        {{yearlevelOption.text}}
                      </option>
                    </select>
                    <span class="text-danger" v-for="error in errors.year_level" :key="error.key">{{ error }}</span>
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleFormControlInput1">Barcode</label>
                  <input type="text" class="form-control" v-model="student.barcode" placeholder="barcode">
                  <span class="text-danger" v-for="error in errors.barcode" :key="error.key">{{ error }}</span>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancelEdit">Close</button>
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
                  <input @keyup.enter="fetchIndexData()" v-model.number="per_page" type="text" class="text-center" style="width:20%;">
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
                  <input @keyup.enter="searchStudent()" v-model="search" type="text" class="form-control" placeholder="student id">
              </div>
          </div>
      </div>

      <table class="table table-hover table-sm">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Student ID</th>
            <th scope="col">Full Name</th>
            <th scope="col">Course</th>
            <th scope="col">Year Level</th>
            <th scope="col">Barcode</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in students" :key="student.key">
            <td>{{student.student_id}}</td>
            <td>{{student.last_name}}, {{student.first_name}} {{student.middle_name}}</td>
            <td>{{student.course}}</td>
            <td>{{student.year_level}}</td>
            <td>{{student.barcode}}</td>
            <td><button type="button" class="btn btn-primary" @click="editStudent(student)" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">Edit</button></td>
          </tr>
        </tbody>
      </table>

      <div class="float-left">
          <label>Showing {{ meta.current_page }} to {{ meta.last_page }} of {{ meta.total }} entries</label>
      </div>

      <div class="float-right">
          <ul class="pagination">
              <li><button type="button" class="btn btn-default" @click="firstPage" :disabled="!this.links.first">&laquo;</button></li>
              <li><button type="button" class="btn btn-default" @click="prevPage" :disabled="!this.links.prev">Previous</button></li>
              <li><button type="button" class="btn btn-default" @click="nextPage" :disabled="!this.links.next">Next</button></li>
              <li><button type="button" class="btn btn-default" @click="lastPage" :disabled="!this.links.last">&raquo;</button></li>
          </ul>
      </div>

    </div>

  </div>
</template>

<script>
    export default {
      data () {
        return {
          links:[],
          meta:[],
          page: 1,
          per_page: 15,
          edit: false,
          search: '',
          errors:[],
          students:[],
          student:{
            student_id: '',
            last_name: '',
            first_name: '',
            middle_name: '',
            course: '',
            year_level: '',
            barcode:''
          },
          courseOptions: [
            {text: 'BSCS', value: 'BSCS'},
            {text: 'BSIT', value: 'BSIT'},
            {text: 'BSCpE', value: 'BSCpE'},
            {text: 'BSBA', value: 'BSBA'},
            {text: 'BSCrim', value: 'BSCrim'},
            {text: 'BSHRM', value: 'BSHRM'},
            {text: 'BSN', value: 'BSN'}
          ],
          yearlevelOptions: [
            {text: '1st', value: '1st'},
            {text: '2nd', value: '2nd'},
            {text: '3rd', value: '3rd'},
            {text: '4th', value: '4th'},
            {text: '5th', value: '5th'}
          ]
        }
      }, //  end data
      mounted() {
        this.loadStudent();
      }, //end mounted
      methods: {
        loadStudent(){
          axios.get('./students').then(response => {
              this.students = response.data.data;
              this.links = response.data.links;
              this.meta = response.data.meta;
          })
        }, //end loadStudent
        searchStudent(){
          axios.get(this.meta.path+'?search='+this.search+'&page='+this.page+'&per_page='+this.per_page).then(response => {
              this.students = response.data.data;
              this.links = response.data.links;
              this.meta = response.data.meta;
          })
        }, //end searchStudent
        fetchIndexData(){
            axios.get('./students'+'?page='+this.page+'&per_page='+this.per_page).then(response => {
                this.students = response.data.data;
                this.links = response.data.links;
                this.meta = response.data.meta;
            })
        }, //end fetchIndexData
         prevPage(){
             axios.get(this.links.prev+'&per_page='+this.per_page+'&search='+this.search).then(response => {
                 this.students = response.data.data;
                 this.links = response.data.links;
                 this.meta = response.data.meta;
             });
         }, //end of  prevPage()
         nextPage(){
             axios.get(this.links.next+'&per_page='+this.per_page+'&search='+this.search).then(response => {
                 this.students = response.data.data;
                 this.links = response.data.links;
                 this.meta = response.data.meta;
             });
         }, //end of nextPage()
         firstPage(){
             axios.get(this.links.first+'&per_page='+this.per_page+'&search='+this.search).then(response => {
                 this.students = response.data.data;
                 this.links = response.data.links;
                 this.meta = response.data.meta;
             });
         }, //end firstPage()
         lastPage(){
             axios.get(this.links.last+'&per_page='+this.per_page+'&search='+this.search).then(response => {
                 this.students = response.data.data;
                 this.links = response.data.links;
                 this.meta = response.data.meta;
             });
         }, //end lastPage()
        addStudent(){
          if(this.edit === false)
          {
            axios.post('./students',this.student).then(response => {
              method: 'post'
              this.students.push(response.data.student);
                this.student = {
                  student_id: '',
                  last_name: '',
                  first_name: '',
                  middle_name: '',
                  course: '',
                  year_level: '',
                  barcode:''
                };
              this.loadStudent();
              this.errors='';
              }).catch(response => {
                this.errors = response.response.data.errors;
              })
          } else {
            axios.patch('./students/'+this.student.id,this.student).then(response => {
              method: 'put'
                this.student = {
                    student_id: '',
                    last_name: '',
                    first_name: '',
                    middle_name: '',
                    course: '',
                    year_level: '',
                    barcode:''
                };
                this.editState = false;
                this.loadStudent();
                this.errors='';
            }).catch(response => {
                this.errors = response.response.data.errors;
            })
          }
        }, //end addStudent
        editStudent(edit){
          this.edit = true;
          this.student = edit;
        }, //end editStudent
        cancelEdit(){
            this.edit = false;
            this.errors='';
            this.loadStudent();
            this.student = {
                student_id: '',
                last_name: '',
                first_name: '',
                middle_name: '',
                course: '',
                year_level: '',
                barcode:''
            };
        }, //end of cancelEdit()
      } //end method
    }
</script>
