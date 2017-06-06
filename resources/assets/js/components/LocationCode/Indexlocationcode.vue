<template lang="html">
  <div class="container">
    <div class="well well-sm">
      <div class="form-inline" method="post">
        <div class="form-group">
          <label for="lokasi">Lokasi</label>
          <input v-model="add.location" type="text" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group">
          <label for="code">KODE</label>
          <input v-model="add.code" type="text" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group">
          <button @click="addData()" class="btn btn-primary" type="submit" name="button">ADD</button>
        </div>
      </div>
    </div>
    <div class="well well-sm">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>LOKASI</th>
            <th>KODE</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for = 'locationcode in locationcodes'>
            <td v-show="showForm(locationcode.id)" >{{locationcode.location}}</td>
            <td v-show="!showForm(locationcode.id)" ><input v-model="edit.location" type="text" name="location" value=""></td>
            <td v-show="showForm(locationcode.id)" >{{locationcode.code}}</td>
            <td v-show="!showForm(locationcode.id)" ><input v-model="edit.code" type="text" name="code" value=""></td>
            <td>
              <button v-show="showForm(locationcode.id)" @click="editData(locationcode.id)" class="bs3-button" type="button" name="button">
                <i class="fa fa-pencil">Edit</i>
              </button>
              <button v-show="showForm(locationcode.id)" @click="deleteData(locationcode.id)" class="bs3-button" type="button" name="button">
                <i class="fa fa-times">Delete</i>
              </button>

              <button @click="updateData(locationcode.id)" class="btn-success" type="submit" v-show="!showForm(locationcode.id)">
                <i class="fa fa-check">Save</i>
              </button>
              <button @click.prevent="editForm=false" v-show="!showForm(locationcode.id)" class="btn-danger" type="button" name="button">
                <i class="fa fa-times">Cancel</i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
        locationcodes:[],

        add:{
          location:"",
          code:""
        },

        editForm:"",
        edit:{
          location:"",
          code:""
        }
    }
  },
  methods:{
    indexLocationCode(){
      axios.get('/locationcode-api')
      .then(response=>{
        this.locationcodes=response.data;
        console.log(response);
      });
    },

    addData(){
      axios.post('/locationcode-api',this.add)
      .then(response=>{
        console.log(response);
        this.indexLocationCode();
      })
    },

    showForm(id){
        if(this.editForm==id){
          return false;
        }
        return true;
      },

      editData(id){
        this.locationcodes.forEach((locationcode,i)=>{
          if(locationcode.id==id){
            this.edit=locationcode;
          }
        });
        return this.editForm=id;
      },

      updateData(id){
        axios.put('/locationcode-api/'+id,this.edit)
        .then(response=>{
          console.log(response);
          this.editForm=false;
          this.indexLocationCode();
        })
        .catch(error=>{
          console.log(error.response);
        })
      },

      deleteData(id){
        axios.delete('/locationcode-api/'+id)
        .then(response=>{
          console.log(response);
          this.indexLocationCode();
        })
      }
  },
  mounted(){
    this.indexLocationCode();
  }
}
</script>

<style lang="css">
</style>
