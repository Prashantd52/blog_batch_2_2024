@extends('backend.layouts.master')
@section('title')
Category List
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection

@section('content')
<section id="server-processing">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Server-side processing</h4>
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
                            <table class="table table-striped table-bordered " id="category-data">
                                <thead>
                                    <tr>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>

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

<script>
    $(document).ready(function() {
        $('#category-data').DataTable({
           "bProcessing": true,
            "serverSide": true,
            "scrollY": true,
            "scrollX": true,
            "pageLength":10,
            "lengthMenu": [10,50,100,1000],
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print','pageLength'
            ],
            "ajax":{
                type: "post",  // type of method  ,GET/POST/DELETE
                url :"{{Route('categories.get_data')}}", // json datasource
                data:{
                    _token: "{{csrf_token()}}",
                },
                error: function(data){
                    $("#addOnList").css("display","none");
                    alert(data.responseText);
                }
            }
            });
        });
</script>
@endsection