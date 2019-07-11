<template>
    <div id="postsrec">

        <div class="row justify-content-center">
            <div v-bind:class="{ succmsg: succmsg }">
                <div class="col-md-12 col-lg-12">
                    <div class="alert alert-success cusmsg">{{ actionmsg }}</div>
                </div>
            </div>
                <div class="card">
                    <div>{{laravelData}}</div>
                    <div class="card-body">
                        <div v-for="line in laravelData.lines">
                            <span>{{line.movie_actor.actor.actor_name}}</span>
                            <span>{{line.line}}</span>
                        </div>
                    </div>
                    <button><a href="#" v-on:click="addLine()" data-target="#exampleModal1"  data-toggle="modal">New Line</a></button>
                </div>
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-bind:class="{ showmodal:showmodal }">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Line</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method = "post" name="addactor" id="addactor" action="#" @submit.prevent="addActor">
                                    <div class="form-group">
                                        <label for="author">Actor</label>
                                        <select class="form-control" name="author" id="author" v-model="line.actor_id" v-for="actor in actors">
                                            <option value="actor.id">{{actor.actor_name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Line</label>
                                        <textarea type="text" name="title" id="title" class="form-control" placeholder="Title" v-model="line.line" />
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        props: ['movieId'],

        data() {
            return {
                line: {},
                actors: {},
                laravelData: {},
                id: '',
                succmsg:  true,
                showmodal: false,
                actionmsg: '',
            }
        },
        methods: {
            actorsList(){
                this.$http.get('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/actors').then((response) => {
                    this.actors = response.data;
                });
            },
            scriptLines(movie_id) {
                this.$http.get('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/scripts?'+movie_id).then((response) => {
                    this.laravelData = response.data;
                });
            },
            addLine(){
                this.$http.post('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/scripts/', {
                    movie_id: this.movieId,
                    line: this.line.line,
                    actor_id: this.line.actor_id
                }).
                then((data) => {
                    this.succmsg = false;
                    console.log(data);
                    this.line = {};
                    var self = this;
                    setTimeout(function(){
                        self.succmsg = true;
                    },3000);
                    this.actionmsg = "Data added successfully";
                    $('#exampleModal').modal('hide');
                    this.scriptLines();
                });
            },
            hideModal() {
                $('#exampleModal2').modal('hide');
            }

        },
        mounted() {
            this.scriptLines(this.movieId);
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
