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
            <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-bind:class="{ showmodal:showmodal }">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Actor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method = "post" name="addactor" id="addactor" action="#" @submit.prevent="addActor">
                                <div class="form-group">
                                    <label for="title">Actor Name</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Actor Full Name" v-model="actor.actor_name" />
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-bind:class="{ showmodal:showmodal }">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Add Movie to Actor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" name="addpost" id="addpost" action="#" @submit.prevent="updatePost">
                        <div>
                            <div class="form-group">
                                <label for="movie">Movie</label>
                                <select class="form-control" name="movie" id="movie" v-model="actor.movie_id">
                                    <option v-for="movie in movies" :value="movie.id">{{movie.movie_name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="character">Character Name</label>
                                <input type="text" name="character" id="character" class="form-control" placeholder="Movie Character Name" v-model="actor.movie_character_name"/>
                            </div>
                            <div class="form-group">
                                <label for="revenue_share">Actor Revenue Share</label>
                                <textarea name="revenue_share" id="revenue_share" class="form-control" placeholder="Revenue Share" v-model="actor.actor_revenue_share"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="base_pay">Actor Base Pay</label>
                                <input type="text" name="base_pay" id="base_pay" class="form-control" placeholder="Base Pay" v-model="actor.actor_base_pay"/>
                            </div>
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
                <button><a href="#" v-on:click="addActor()" data-target="#exampleModal1"  data-toggle="modal">Add Actor</a></button>
                <div class="card-body">
                    <table class="table">
                    <tbody v-for="actor in laravelData" :key="actor.id">
                      <tr>
                        <th scope="row">{{ actor.actor_name }}</th>
                        <td><a href="#" v-on:click="editPost(actor.id)" data-target="#exampleModal2"  data-toggle="modal" v-bind:actor_name="actor.actor_name">Add Movie</a></td>
                      </tr>
                    <tr>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                            <th scope="col">Movie</th>
                            <th scope="col">Actor Base Pay</th>
                            <th scope="col">Actor Revenue Share</th>
                            <th scope="col">Movie Character</th>
                            </tr>
                            </thead>
                            <tbody v-for="actor_movie in actor.actor_movies">
                            <tr>
                                <th scope="row">{{ actor_movie.movie.movie_name }}</th>
                                <th scope="row">{{ actor_movie.actor_base_pay }}</th>
                                <th scope="row">{{ actor_movie.actor_revenue_share }}</th>
                                <th scope="row">{{ actor_movie.movie_character_name }}</th>
                            </tr>
                            </tbody>
                        </table>
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
    name: 'actors-component',
        data() {
            return {
                movies: {},
                actor: {},
                laravelData: {},
                id: '',
                succmsg:  true,
                showmodal: false,
                actionmsg: '',
            }
        },
        methods: {
            movieList(){
                this.$http.get('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/movies').then((response) => {
                    this.movies = response.data.data;
                });
            },
            postLists() {
                this.$http.get('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/actors?page=1').then((response) => {
                    this.laravelData = response.data.data;
                });
            },
            addActor(){
                this.$http.post('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/actors',
                    {
                        'actor_name': this.actor.actor_name
                    }).
                then((data) => {
                    this.succmsg = false;
                    console.log(data);
                    this.actor = {};
                    var self = this;
                    setTimeout(function(){
                        self.succmsg = true;
                    },3000);
                    this.actionmsg = "Data added successfully";
                    $('#exampleModal1').modal('hide');
                    this.postLists(this.pagenumber);
                });
            },
            editPost(postid) {
                this.movieList();
                this.id = postid;
            },
            updatePost() {
                   this.$http.put('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/actors/'+this.id,
                       {
                           'actor_id': this.id,
                           'movie_id': this.actor.movie_id,
                            'actor_revenue_share': this.actor.actor_revenue_share,
                            'actor_base_pay': this.actor.actor_base_pay,
                            'movie_character_name': this.actor.movie_character_name
                    }).
                    then((data) => {
                        this.succmsg = false;
                        console.log(data);
                        this.actor = {};
                        var self = this;
                        setTimeout(function(){
                            self.succmsg = true;
                        },3000);
                        this.actionmsg = "Data updated successfully";
                        $('#exampleModal2').modal('hide');
                        this.postLists(this.pagenumber);
                    });
            },
            hideModal(modal) {
                $('#exampleModal2').modal('hide');
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
