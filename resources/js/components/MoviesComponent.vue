<template>
    <div id="postsrec">

        <div class="row justify-content-center">
            <div v-bind:class="{ succmsg: succmsg }">
                <div class="col-md-12 col-lg-12">
                    <div class="alert alert-success cusmsg">{{ actionmsg }}</div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-bind:class="{ showmodal:showmodal }">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Movie</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" name="addpost" id="addpost" action="#" @submit.prevent="addMovie">
                                    <div class="form-group">
                                        <label for="title">Movie Name</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Movie Name" v-model="movie.movie_name" />
                                    </div>
                                    <div class="form-group">
                                    <label for="author">Production Company</label>
                                    <select class="form-control" name="author" id="author" v-model="movie.production_companies_id" v-for="company in productionCompanies">
                                        <option value="company.id">{{company.company_name}}</option>
                                    </select>
                                </div>
                                    <div class="form-group">
                                        <label for="revenue">Production Company Revenue Share</label>
                                        <input type="text" name="title" id="revenue" class="form-control" placeholder="Title" v-model="movie.production_company_revenue_share" />
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <button><a href="#" v-on:click="newMovie()" data-target="#exampleModal"  data-toggle="modal">Add Movie</a></button>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Movie Name</th>
                                <th scope="col">Production Company</th>
                                <th scope="col">Production Company Revenue Share</th>
                                <th scope="col">Script</th>
                            </tr>
                            </thead>
                            <tbody v-for="movie in laravelData">
                            <tr>
                                <th scope="row">{{ movie.movie_name }}</th>
                                <th scope="row">{{ movie.production_company.company_name }}</th>
                                <th scope="row">{{ movie.production_company_revenue_share }}</th>
                                <td><a href="#" v-on:click="editScript(movie.id)" class="btn btn-primary">View</a></td>
                            </tr>
                            <tr v-if="showScriptComponent[movie.id]">
                                <span>{{ movie.script }}</span>
                                <scripts-component :movie-id="movie.id"></scripts-component>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {

        data() {
            return {
                productionCompanies: {},
                movie: {},
                laravelData: {},
                id: '',
                succmsg:  true,
                showmodal: false,
                actionmsg: '',
                showScriptComponent: []
            }
        },
        methods: {
            editScript(movie_id){
              this.showScriptComponent[movie_id] = !this.showScriptComponent[movie_id];
            },
            companiesList(){
                this.$http.get('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/production_companies').then((response) => {
                    this.productionCompanies = response.data.data;
                });
            },
            postLists() {
                this.$http.get('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/movies?page=1').then((response) => {
                    this.laravelData = response.data.data;
                    this.laravelData.forEach(function (movie) {
                        this.showScriptComponent[movie.id] = false;
                    })
                });
            },
            newMovie(){
              this.companiesList();
            },
            addMovie(){
                this.$http.post('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/movies/', this.movie ).
                then((data) => {
                    this.succmsg = false;
                    console.log(data);
                    this.movie = {};
                    var self = this;
                    setTimeout(function(){
                        self.succmsg = true;
                    },3000);
                    this.actionmsg = "Data added successfully";
                    $('#exampleModal').modal('hide');
                    this.postLists(this.pagenumber);
                });
            },
            hideModal(modal) {
                $(modal).modal('hide');
            }

        },
        mounted() {
            this.postLists();
        }
    }
</script>
<style scoped>
    .succmsg {
        display: none;
    }
    .showmodal {
        display: none !important;
        opacity: 0;
    }
</style>
