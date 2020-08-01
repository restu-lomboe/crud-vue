<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>CRUD VUE</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">CRUD VUE LARAVEL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            </div>
        </div>
    </nav>

    <div class="card-body mt-5 border rounded" id="app">
        <h1 class="h3 text-center">Input Form Artikel</h1>
        <div class="col-md-10 mx-auto">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" v-model="newJudul" @keyup.enter="addTodo" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" v-model="newDesc" @keyup.enter="addTodo" class="form-control" >
            </div>
        </div>

        <table class="table col-md-10 mx-auto mt-5">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(todo , index) in todos">
                <th scope="row">1</th>
                <td> @{{ todo.judul }} </td>
                <td> @{{ todo.desc }} </td>
                <td>
                    <button type="button" class="btn btn-success btn-sm" v-on:click="removeTodo(todo)">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" v-on:click="editTodo(index , todo)" >Hapus</button>
                </td>
              </tr>
            </tbody>
        </table>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
<script>
    var app = new Vue({
    el: '#app',
        data: {
            newJudul : "",
            newDesc : "",
            todos : []
        },
        methods : {
            addTodo : function(){
                let judulInput = this.newJudul.trim();
                let descInput = this.newDesc.trim();
                if (judulInput) {
                    //store data
                    this.$http.post('/api/artikel', {
                        judul : judulInput,
                        desc : descInput
                    }).then(response => {
                        this.todos.unshift({
                            judul : judulInput,
                            desc : descInput
                        })
                    });
                }
            },
            removeTodo : function(index, todo){
                //delete data
                this.$http.post('/api/artikel/delete/' + todo.id).then(response => {
                    this.todos.splice(index, 1)
                });
            },
            editTodo : function(todo){
                //masih blm paham kk
            }
        },
        mounted : function(){
            //menampilkan data
            this.$http.get('/api/artikel').then(response => {
                let result = response.body.data;
                this.todos = result
            });
        }
    });
</script>
</body>
</html>
