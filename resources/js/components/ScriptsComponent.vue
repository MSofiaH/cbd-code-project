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
                                <h5 class="modal-title" id="exampleModalLabel">New Line</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method = "post" name="addline" id="addline" action="#" @submit.prevent="addLine">
                                    <div class="form-group">
                                        <label for="actor">Actor</label>
                                        <select class="form-control" name="actor" id="actor" v-model="line.actor_id">
                                            <option :value="movieActor.id" v-for="movieActor in actors">
                                                {{movieActor.actor.actor_name}} / {{movieActor.movie_character_name}}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="line">Line</label>
                                        <textarea name="line" id="line" class="form-control" placeholder="Character Line" v-model="line.line"></textarea>
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
            <div class="card">
                <div>{{laravelData}}</div>
                <div class="card-body">
                    <div v-for="line in lines">
                        <span><b>{{line.movie_actor.actor.actor_name}} / {{line.movie_actor.movie_character_name}}</b></span>
                        <span>{{line.line}}</span>
                    </div>
                </div>
                <button><a href="#" v-on:click="actorsList()" data-target="#exampleModal" data-toggle="modal">New Line</a></button>
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
                lines: {},
            }
        },
        methods: {
            actorsList(){
                this.$http.get('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/actor_movie?movie='+this.movieId).then((response) => {
                    this.actors = response.data.data;
                });
            },
            script() {
                this.$http.get('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/scripts?'+this.movieId).then((response) => {
                    this.laravelData = response.data.data[0];
                    this.lines = this.laravelData.lines;
                });
            },
            addLine(){
                this.$http.post('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/scripts', {
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
                    this.script();
                });
            },
            hideModal() {
                $('#exampleModal').modal('hide');
            }
        },
        mounted() {
            this.script();
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
