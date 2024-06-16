@extends('qc_dashboard')

@section('qccontent')
<link href="{{asset('/css/sheet.css')}}" rel="stylesheet">

<div class="row" id="title_bar">

    <hr>
    <main class="container">
        <div class="col" id="form_title">
            <div class="col col-sm-12 col-xs-12">
                <h4 class="title fw-bold"> Material Mixture of the sheet<span></span></h4>

            </div>
        </div>




        <!-----------------------------------Mixcher add------------------------------------------------>





        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css /> -->

        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="panel">
                    <div class="panel-body table-responsive">

                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th> TotalQty </th>
                                    <th> Total Mixed </th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qty = 0;
                                $mixed = 0;
                                ?>
                                @foreach($data as $d)
                                <tr>
                                    <td>{{$d['mx_bulk_id']}}</td>
                                    <td>{{$d['tot_qty']}}</td>
                                    <td>{{$d['tot_mix']}} %</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#viewMixture" data-id="{{$d['mx_bulk_id']}}" data-qty="{{$d['tot_qty']}}" data-mix="{{$d['tot_mix']}}" class="btn btn-outline-danger btn-sm viewmixture">View Mixture</a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>

                </div>



    </main>
</div>
</div>
</div>

<div class="modal fade" id="viewMixture" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Mixture</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-responsive">
                            <thead>
                                <th>Material</th>
                                <th>Batch No</th>
                                <th>Brand</th>
                                <th>Qty</th>
                                <th>Mixed</th>
                            </thead>
                            <tbody id="tbody">


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="fw-bold text-right">Total Qty</td>
                                    <td colspan="1" class="tot_qty fw-bold"></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="fw-bold text-right">Total Mixed</td>
                                    <td colspan="1" class="tot_mix fw-bold"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('page-scripts')
<script>
    $(document).ready(function() {
        mix = <?php echo json_encode($mixtures); ?>;
        new_data = [];
        $('.viewmixture').on('click', function() {
            new_data = [];
            var id = $(this).attr('data-id');
            var qty = $(this).attr('data-qty');
            var mixed = $(this).attr('data-mix');
            for (let index = 0; index < mix.length; index++) {
                if (mix[index]['mx_bulk_id'] == id) {
                    new_data.push(mix[index]);
                }
            }
            $('#tbody').html(
                $.map(new_data, function(cell) {
                    return `
                    <tr>
                    <td>`+cell.mx_material+`</td>
                    <td>`+cell.mx_our_bn_no+`</td>
                    <td>`+cell.mx_mt_brand+`</td>
                    <td>`+cell.mx_qty+`</td>
                    <td>`+cell.mx_mixed+`</td>
                </tr>
                    `;
                })
            );

            $('.tot_qty').text(qty);
            $('.tot_mix').text(mixed+'%');
        });


    });
</script>
@endsection