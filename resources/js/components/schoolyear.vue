<template>
  <div>
    <!-- Create button -->
    <div class="py-4">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">Create New School Year</button>
    </div>

    <!-- Modal -->
    <form @submit.prevent="addSchoolYear">
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">School Year Information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cancelEdit">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form row">
                <div class="form-group col-md-4">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">School Year</label>
                    <input type="text" class="form-control" placeholder="school year" v-model="school_year.school_year">
                    <span class="text-danger" v-for="error in errors.school_year" :key="error.key">{{ error }}</span>
                  </div>
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
                  <input @keyup.enter="searchSchoolYear()" v-model="search" type="text" class="form-control" placeholder="school year">
              </div>
          </div>
      </div>

      <table class="table table-hover table-sm">
        <thead class="thead-dark">
          <tr>
            <th scope="col">School Year</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="schoolyear in schoolyears" :key="schoolyear.key">
            <td>{{schoolyear.school_year}}</td>
            <td><button type="button" class="btn btn-primary" @click="editSchoolYear(schoolyear)" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">Edit</button></td>
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
      schoolyears:[],
      school_year:{
        school_year:''
      }
    }
  }, //end data
  mounted() {
    this.loadSchoolYear();
  },
  methods: {
    loadSchoolYear(){
      axios.get('./schoolyear').then(response => {
          this.schoolyears = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
      })
    }, //end loadSchoolYear
    searchSchoolYear(){
      axios.get(this.meta.path+'?search='+this.search+'&page='+this.page+'&per_page='+this.per_page).then(response => {
          this.schoolyears = response.data.data;
          this.links = response.data.links;
          this.meta = response.data.meta;
      })
    }, //end searchSchoolYear
    fetchIndexData(){
        axios.get('./schoolyear'+'?page='+this.page+'&per_page='+this.per_page).then(response => {
            this.schoolyears = response.data.data;
            this.links = response.data.links;
            this.meta = response.data.meta;
        })
    }, //end fetchIndexData
     prevPage(){
         axios.get(this.links.prev+'&per_page='+this.per_page+'&search='+this.search).then(response => {
             this.schoolyears = response.data.data;
             this.links = response.data.links;
             this.meta = response.data.meta;
         });
     }, //end of  prevPage()
     nextPage(){
         axios.get(this.links.next+'&per_page='+this.per_page+'&search='+this.search).then(response => {
             this.schoolyears = response.data.data;
             this.links = response.data.links;
             this.meta = response.data.meta;
         });
     }, //end of nextPage()
     firstPage(){
         axios.get(this.links.first+'&per_page='+this.per_page+'&search='+this.search).then(response => {
             this.schoolyears = response.data.data;
             this.links = response.data.links;
             this.meta = response.data.meta;
         });
     }, //end firstPage()
     lastPage(){
         axios.get(this.links.last+'&per_page='+this.per_page+'&search='+this.search).then(response => {
             this.schoolyears = response.data.data;
             this.links = response.data.links;
             this.meta = response.data.meta;
         });
     }, //end lastPage()
    addSchoolYear(){
      if(this.edit === false){
        axios.post('./schoolyear',this.school_year).then(response => {
          method: 'post'
          this.schoolyears.push(response.data.school_year);
            this.school_year = {
              school_year:''
            };
          this.loadSchoolYear();
          this.errors='';
          }).catch(response => {
            this.errors = response.response.data.errors;
          })
      } else {
        axios.patch('./schoolyear/'+this.school_year.id,this.school_year).then(response => {
          method: 'put'
            this.school_year = {
              school_year:''
            };
            this.editState = false;
            this.loadSchoolYear();
            this.errors='';
        }).catch(response => {
            this.errors = response.response.data.errors;
        })
      }
    }, //end addSchoolYear
    editSchoolYear(edit){
      this.edit = true;
      this.school_year = edit;
    }, //end editSchoolYear
    cancelEdit(){
        this.edit = false;
        this.errors='';
        this.loadSchoolYear();
        this.school_year = {
          school_year:''
        };
    }, //end of cancelEdit()
  }
}
</script>
