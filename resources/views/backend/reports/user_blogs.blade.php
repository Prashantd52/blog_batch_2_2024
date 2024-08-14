@extends('backend.layouts.master')
@section('title')
Blog Reports
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.css">
@endsection


@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Month Wise Blog Report</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <canvas id="column-chart" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<section id="server-processing">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blog Reports</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered " id="blog-data">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Blogs Count</th>
                                        <th>Latest Blog</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->name}}</td>
                                            <td>{{ $record->blogs_count}}</td>
                                            <td>{{ $record->latest_blog->title }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-js')
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="../../../app-assets/js/scripts/tables/datatables-extensions/datatables-sources.js"></script>
<script src="../../../app-assets/vendors/js/charts/chart.min.js"></script>
<script>
    $(document).ready(function() {
        $('#blog-data').DataTable({
           
        });

            //Get the context of the Chart canvas element we want to select
            var ctx = $("#column-chart");

            // Chart Options
            var chartOptions = {
                // Elements options apply to all of the options unless overridden in a dataset
                // In this case, we are setting the border of each bar to be 2px wide and green
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                responsiveAnimationDuration:500,
                legend: {
                    position: 'top',
                },
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false,
                        },
                        scaleLabel: {
                            display: true,
                        }
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false,
                        },
                        scaleLabel: {
                            display: true,
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Month wise Blogs'
                }
            };

            // Chart Data
            var chartData = {
                labels: ["January", "February", "March", "April", "May","June","July","August","September","October","November","December"],
                datasets: [{
                    label: "No of Blogs",
                    data: [{{$monthWiseBlogs['01']}}, {{$monthWiseBlogs['02']}}, {{$monthWiseBlogs['03']}}, {{$monthWiseBlogs['04']}}, {{$monthWiseBlogs['05']}}, {{$monthWiseBlogs['06']}}, {{$monthWiseBlogs['07']}}, {{$monthWiseBlogs['08']}}, {{$monthWiseBlogs['09']}}, {{$monthWiseBlogs['10']}}, {{$monthWiseBlogs['11']}}, {{$monthWiseBlogs['12']}}],
                    backgroundColor: "#28D094",
                    hoverBackgroundColor: "rgba(22,211,154,.9)",
                    borderColor: "transparent"
                }]
            };

            var config = {
                type: 'bar',

                // Chart Options
                options : chartOptions,

                data : chartData
            };

            // Create the chart
            var lineChart = new Chart(ctx, config);
        
    });
</script>
@endsection