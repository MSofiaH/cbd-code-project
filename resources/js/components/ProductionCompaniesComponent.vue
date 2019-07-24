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
                                <h5 class="modal-title" id="exampleModalLabel">Add Production Company</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method = "post" name="addpost" id="addpost" action="#" @submit.prevent="addCompany">
                                    <div class="form-group">
                                        <label for="title">Company Name</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" v-model="company.company_name" />
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
                    <button><a href="#" v-on:click="addCompany()" data-target="#exampleModal"  data-toggle="modal">Add Production Company</a></button>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody v-for="company in laravelData">
                            <tr>
                                <th scope="row">{{ company.company_name }}</th>
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
                company: {},
                laravelData: {},
                id: '',
                succmsg:  true,
                showmodal: false,
                pagenumber: 1,
                actionmsg: '',
            }
        },
        methods: {
            postLists() {
                this.$http.get('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/production_companies?page=1').then((response) => {
                    this.laravelData = response.data.data;
                });
            },
            addCompany(){
                this.$http.post('http://php-codeproject-cbs-mshidalgor89968412.codeanyapp.com/api/production_companies/', this.company ).
                then((data) => {
                    this.succmsg = false;
                    console.log(data);
                    this.company = {};
                    var self = this;
                    setTimeout(function(){
                        self.succmsg = true;
                    },3000);
                    this.actionmsg = "Data added successfully";
                    $('#exampleModal').modal('hide');
                    this.postLists(this.pagenumber);
                });
            },
            hideModal() {
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
