<template>
    <div class="container">
        <div class="row">
            <table class="table table-hover table-striped table-bordered">
              <thead>
                <tr><td>id</td><td>title</td></tr>
                  </thead>
                  <tbody>
                  <tr  v-for="(item,key) in data" ><td>{{ item.id }}</td><td>{{ key }}{{ item.title }}</td></tr>
                  </tbody>
               </table>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" v-model="name" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
                      <label for="exampleInputName">name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" v-model="name"  placeholder="name">
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox"> Check me out
            </label>
          </div>
          <button type="submit" @click="doSub" class="btn btn-default">Submit</button>
    </div>
</template>
<script>
export default{
    mounted(){
            console.log('zzz');
    },
    data:function(){
        return {
            message:"abc",
            data:"",
            name:""
        }
    },
    created: function() {

          axios.get('/vue_data').then((response) =>{
                var json = response.data;
                this.data = json;
                console.log(json);
          }).catch(function(error){
            console.log(error);
          });
    },
    methods:{
        doSub:function(event){
            alert(this.name);
        }
    }
}
</script>