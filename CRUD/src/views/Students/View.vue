<template>
    <div class="container">
        <div class="card">
            <h4>
                students
                <RouterLink to="/students/create" class="btn btn-primary float-end"> 
                    Add Student
                </RouterLink>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Creat At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- Mengisi data dalam form -->
                <tbody v-if="this.students.length > 0">
                    <tr v-for="(student,index) in this.students" :key="index">
                        <td>{{ student.id }}</td>
                        <td>{{ student.name }}</td>
                        <td>{{ student.course }}</td>
                        <td>{{ student.email }}</td>
                        <td>{{ student.phone }}</td>
                        <td>{{ student.created_at }}</td>
                        <td>
                            <RouterLink :to="{path: '/students/'+student.id+'/edit'}" class="btn btn-success ">  
                                Edit
                            </RouterLink>
                            <button type="button" @click="deleteStudent(student.id)" class="btn btn-danger ">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>

                <tbody v-else>
                    <tr>
                        <td colspan="7">Loading...</td>
                    </tr>

                </tbody>


            </table>
        </div>
    </div>
  </template>

  <script>
  import axios from 'axios'
  export default{
    name:'students',
    data(){
        return{
            students: []
        }
    },
    mounted(){
        this.getStudents();
        // console.l,og("i AM Here") //For the checking
    },
    methods:{
        getStudents(){                  //Untuk mengambil data dari http
            axios.get('http://localhost:8000/api/students').then(res =>{
                this.students=res.data.students
                console.log(this.students)
            });
        },
        deleteStudent(studentId){
            if(confirm("Are You sure, you want to delete this data")){
                axios.delete(`http://localhost:8000/api/students/${studentId}/destroy`)
                .then(res => {
                    alert(res.data.message);
                    this.getStudents();
                                    
                })
                .catch(function (error){
                    if(error.response){
                        if(error.response.status == 404){
                            alert(error.response.data.message);
                        }
                    }
                });
            }

        }
    }
  }




</script>
  
  
  