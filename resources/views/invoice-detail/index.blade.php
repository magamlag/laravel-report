@extends('layouts.master')
@section('css')

    <!-- Begin Css For Chart -->
    <!--you should move chart style to a permanent home -->

    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }

        #chart {
            width: 600px;
            height: 400px;
            margin-bottom: 150px;

        }

        #label {

            margin-top: 20px;
        }
    </style>
    <!-- End Css For Chart -->
    <!-- Begin Css For Vue -->
    <!--you should move vue style to a permanent home -->
    <style>
        [v-cloak] {
            display:none;
        }

        th.active .arrow {
            opacity: 1;
        }

        .arrow {
            display: inline-block;
            vertical-align: middle;
            width: 0;
            height: 0;
            margin-left: 5px;
            opacity: 0.66;
        }

        .arrow.asc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid black;
        }

        .arrow.dsc {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid black;
        }
        table thead tr th {
            cursor: pointer;
        }
    </style>
    <!-- End Css For Vue -->
@endsection

@section('content')

<ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/invoice-detail'>InvoiceDetails</a></li>
        </ol>

<!-- Begin InvoiceDetail Chart -->

<div id="chart">

<script type="text/x-template" id="graph-template">

    <div class="form-group pull-left">
        <label for="type">chart type:</label>
        <select class="form-control" id="type" v-model="type" v-on:change="changeType">
            <option>line</option>
            <option>bar</option>

        </select>


        <label for="period" id="label">chart periods:</label>
        <select class="form-control" id="period" v-model="period" v-on:change="changePeriod">
            <option value="1year">1 year</option>
            <option value="3months">3 months</option>
            <option value="30days">30 days</option>
            <option value="1week">1 week</option>

        </select>

    </div>

    <canvas id="canvass" width="600" height="400"></canvas>

    </script>

<!-- vue chart component-->

<div id="graph">
    <graph></graph>
</div>

</div>

<!-- End InvoiceDetail Chart -->

        <h1>InvoiceDetails</h1>


    <!-- component template -->
    <script type="text/x-template" id="grid-template">
        <div class="row">
            <div class="col-lg-12">
            <form id="search">
                    Search <input name="query" v-model="query" @keyup="search(query)">
                </form>
            <div class="pull-right">
                    @{{ total }} Total Results
            </div>
                <section class="panel">
                    <div class="panel-body">

                     <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th v-for="key in columns"
                @click="sortBy(key)"
                :class="{active: sortKey == key}">
                @{{key | capitalize}}
                <span class="arrow"
                      :class="sortOrder > 0 ? 'asc' : 'dsc'">
          </span>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in data">
                <td>
                    @{{row.Id}}
                </td>
                <td>
                    <a href="/invoice-detail/@{{row.Id}}">@{{row.Name}}</a>
                </td>
                <td>
                    @{{row.Created | formatDate}}
                </td>
                <td ><a href="/invoice-detail/@{{row.Id}}/edit"> <button type="button" class="btn btn-default">Edit</button></a></td>
            </tr>
            </tbody>
        </table>
                    </div>

                    <div class="pull-right">

                    page @{{ current_page }} of   @{{ last_page }} pages
                    </div>

            </section>
            <div class="row">
            <div class="pull-right" style="margin-top:20px; margin-left:20px;">

                <button @click="getData(go_to_page)"class="btn btn-default">
                Go To Page:</button>
                <input v-model="go_to_page"></input>

            </div>

            <!-- paginate here -->

                <ul class="pagination pull-right">
                    <li><a @click="getData(first_page_url)"> << </a></li>
                    <li v-if="checkUrlNotNull(prev_page_url)"><a @click.prevent="getData(prev_page_url)" >prev</a></li>
                    <li v-for="page in pages" v-if="page > current_page - 2 && page < current_page + 2" v-bind:class="{'active': checkPage(page)}"> <a @click="getData(page)">@{{ page }}</a></li>
                    <li v-if="checkUrlNotNull(next_page_url)"><a @click="getData(next_page_url)">next</a></li>
                    <li><a @click="getData(last_page_url)"> >> </a></li>
                </ul>
    </div>
        </div>
        </div>

    </script>

    <!-- component tag -->
    <div id="invoiceDetail">
        <invoice-detail-grid
                :data="gridData"
                :columns="gridColumns"
                :query="query"
                :total="total"
                :next_page_url="next_page_url"
                :prev_page_url="prev_page_url"
                :last_page="last_page"
                :current_page="current_page"
                :pages="pages"
                :last_page_url="last_page_url"
                :first_page_url="first_page_url"
                :go_to_page="go_to_page">
        </invoice-detail-grid>
    </div>

    <div> <a href="/invoice-detail/create">
              <button type="button" class="btn btn-lg btn-primary">
                        Create New
              </button></a>
            </div>
@endsection

@section('scripts')


    <!-- jquery required before -->
    <!-- Begin Vue CDN Call -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.21/vue.min.js"></script>
    <!-- End Vue CDN Call -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js"></script>
    <!-- End Grid Requirement -->

    <!-- Begin Chart.js CDN Call-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
    <!-- End Chart.js CDN Call-->

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        Vue.filter('formatDate', function(value){

           <!-- instantiate a moment object and hand it the string date -->

            var d = moment(value);
            var month = d.month() +1 < 10 ? "0" + (d.month() +1) : d.month() +1;
            var day = d.date()  < 10 ? "0" + (d.date()): d.date();
            return month + "/" + day + "/" + d.year();
        });

        <!-- register the grid component -->

        Vue.component('invoice-detail-grid', {
            template: '#grid-template',
            props: {
                data: Array,
                columns: Array,
                query: String,
                total: Number,
                next_page_url: String,
                prev_page_url: String,
                last_page: Number,
                current_page: Number,
                pages:  Array,
                first_page_url: String,
                last_page_url: String,
                go_to_page: Number
            },
            data: function () {
                var sortOrder = 1;
                var sortKey = '';

                return {
                    sortKey: sortKey,
                    sortOrder: sortOrder
                }
            },
            methods: {
                sortBy: function (key) {
                    this.sortKey = key;
                    this.sortOrder = (this.sortOrder == 1) ? -1 : 1;
                    this.getData(1);

                },

                search: function(query){

                this.getData(query);

                },

                getData: function (page) {

                    switch (page){

                        case this.prev_page_url :

                                    getPage = this.prev_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                                    break;

                        case this.next_page_url :

                                getPage = this.next_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                                break;


                        case this.first_page_url :

                            getPage = this.first_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                        case this.last_page_url :

                            getPage = this.last_page_url + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                            case this.query :

                            getPage = 'api/invoice-detail-vue?keyword=' + this.query + '&column=' + this.sortKey + '&direction=' + this.sortOrder;

                            break;

                        case this.go_to_page :

                            if( this.go_to_page != '' && this.go_to_page <= parseInt(this.last_page)){

                                getPage = 'api/invoice-detail-vue?page=' + this.go_to_page + '&column=' + this.sortKey + '&direction=' + this.sortOrder + '&keyword=' + this.query;

                                this.go_to_page = '';

                            } else {

                                alert('Please enter a valid page number');
                            }

                            break;

                        default :

                            getPage = 'api/invoice-detail-vue?page=' + page + '&column=' + this.sortKey + '&direction=' + this.sortOrder + '&keyword=' + this.query;

                            break;
                    }

                    if (this.query == '' && getPage != null){

                        $.getJSON(getPage, function (data) {
                            this.data = data.data;
                            this.total = data.total;
                            this.last_page =  data.last_page;
                            this.next_page_url = data.next_page_url;
                            this.prev_page_url = data.prev_page_url;
                            this.current_page = data.current_page;
                            }.bind(this));

                    } else {

                        if (getPage != null){

                            $.getJSON(getPage, function (data) {
                            this.data = data.data;
                            this.total = data.total;
                            this.last_page =  data.last_page;
                            this.next_page_url = (data.next_page_url == null) ? null : data.next_page_url + '&keyword=' +this.query;
                            this.prev_page_url = (data.prev_page_url == null) ? null : data.prev_page_url + '&keyword=' +this.query;
                            this.first_page_url = 'api/invoice-detail-vue?page=1&keyword=' +this.query;
                            this.last_page_url = 'api/invoice-detail-vue?page=' + this.last_page + '&keyword=' +this.query;
                            this.current_page = data.current_page;
                            this.resetPageNumbers();
                            }.bind(this));

                    }

                }

                },
                checkPage: function(page){

                    return page == this.current_page;

                },

                resetPageNumbers: function(){

                    this.pages = [];

                    for (var i = 1; i <= this.last_page; i++) {
                        this.pages.push(i);

                    }


                },

                checkUrlNotNull: function(url){

                    return url != null;

                }
            }
        });

        <!-- bootstrap the vue instance -->
        var invoiceDetail = new Vue({
            el: '#invoiceDetail',
            data: {
                query: '',
                gridColumns: ['Id', 'Name', 'Created'],
                gridData: [],
                total: null,
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
                current_page: null,
                pages: [],
                first_page_url: null,
                last_page_url: null,
                go_to_page: null
            },
            ready: function () {
                this.loadData();
            },

            components: 'invoice-detail-grid',

            methods: {
                loadData: function () {
                    $.getJSON('api/invoice-detail-vue', function (data) {
                        this.gridData = data.data;
                        this.total = data.total;
                        this.last_page =  data.last_page;
                        this.next_page_url = data.next_page_url;
                        this.prev_page_url = data.prev_page_url;
                        this.current_page = data.current_page;
                        this.first_page_url = 'api/invoice-detail-vue?page=1';
                        this.last_page_url = 'api/invoice-detail-vue?page=' + this.last_page;
                        this.setPageNumbers();
                    }.bind(this));
                },

                setPageNumbers: function(){

                    for (var i = 1; i <= this.last_page; i++) {
                        this.pages.push(i);

                    }


                }

            }
        });
    </script>
    <!-- Begin Chart Script -->

    <!--you should move this to a permanent home -->

    <script>

        var $myChart;

        // register the graph component

        Vue.component('graph', {
            template: '#graph-template',

            data: function(){

                return {
                    labels: [],
                    values: [],
                    name: 'InvoiceDetail',
                    type: 'line',
                    period: '1year'
                };

            },

            ready: function () {

                this.loadData();

            },

            methods: {

                changeType: function () {

                    this.setConfig();

                },

                loadData: function () {

                    $.getJSON('api/invoice-detail-chart', function (data) {

                        this.labels = data.data.labels;
                        this.values = data.data.values;
                        this.setConfig(this.type);

                    }.bind(this));

                },

                changePeriod: function () {

                    $.getJSON('api/invoice-detail-chart?period=' + this.period, function (data) {

                        this.labels = data.data.labels;
                        this.values = data.data.values;
                        this.setConfig(this.type);

                    }.bind(this));

                },

                setConfig : function () {
                    var ctx = document.getElementById('canvass').getContext('2d');
                    var config = {
                        type: this.type,
                        data: {
                            labels: this.labels,
                            datasets: [{
                                label: this.name,
                                data: this.values,
                                fill: true,
                                borderDash: [5, 5]
                            }]
                        },
                        options: {
                            responsive: true,
                            legend: {
                                position: 'bottom'
                            },
                            hover: {
                                mode: 'label'
                            },
                            scales: {
                                xAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: false,
                                        labelString: 'months'
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    scaleLabel: {
                                        display: true,
                                        labelString: '# of ' + this.name
                                    }
                                }]
                            },
                            title: {
                                display: true,
                                text: this.name
                            }
                        }
                    };

                        // destroy existing chart

                        if (typeof $myChart !== "undefined") {
                            $myChart.destroy();
                        }

                    // set instance, so we can destroy when rendering new chart

                   $myChart = new Chart( ctx, { type: this.type, data: config.data, options:config.options });
                }

            }


        });


      // new vue instance

    var chart = new Vue ({

        el: '#chart'

    });

    </script>

    <!-- End Chart Script -->
@endsection