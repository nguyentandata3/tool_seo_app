@extends('master')
@section('css')
    <!-- Responsive Table css -->
    <link href=" {{asset('assets/libs/admin-resources/rwd-table/rwd-table.min.css')}} " rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <?php $data_keyword = $data['keyword']; ?>
    <div>Keyword: {{$data_keyword->keyword}}</div>
    <?php $data_serprobots = $data['serprobots'] ?>
    @foreach ($data_serprobots as $key_data_serprobot => $data_serprobot)
    <div class="card mb-0">
        <div class="card-header" id="headingNine">
            <h5 class="m-0 position-relative">
                <a class="custom-accordion-title text-reset d-block collapsed" data-bs-toggle="collapse" href="#collapseNine{{$key_data_serprobot}}" aria-expanded="false" aria-controls="collapseNine">
                    {{ date('d/m/Y', strtotime($data_serprobot->created_at)) }} <i class="mdi mdi-chevron-down accordion-arrow"></i>
                </a>
            </h5>
        </div>
        <div id="collapseNine{{$key_data_serprobot}}" class="collapse" aria-labelledby="headingFour" data-bs-parent="#custom-accordion-one" style="">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="responsive-table-plugin">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Domain</th>
                                                    <th data-priority="1">DA</th>
                                                    <th data-priority="1">PA</th>
                                                    <th data-priority="1">Moz Rank</th>
                                                    <th data-priority="1">Links</th>
                                                    <th data-priority="1">Equity</th>
                                                    <th data-priority="1">SR Domain</th>
                                                    <th data-priority="1">SR Rank</th>
                                                    <th data-priority="1">SR Keywords</th>
                                                    <th data-priority="1">SR Traffic</th>
                                                    <th data-priority="1">SR Costs</th>
                                                    <th data-priority="1">SR Ulinks</th>
                                                    <th data-priority="1">SR Hlinks</th>
                                                    <th data-priority="1">SR Dlinks</th>
                                                    <th data-priority="1">FB Comments</th>
                                                    <th data-priority="1">FB Shares</th>
                                                    <th data-priority="1">FB Reactions</th>
                                                </tr>
                                            </thead>
                                            <?php $data_seoranks = DB::table('tool_cms_data_seoranks')->where('data_serprobot_id', $data_serprobot->id)->get();?>
                                            <tbody>
                                            @foreach ($data_seoranks as $key_seorank => $data_seorank)
                                                <tr>
                                                    <th><a data_seorank={{$data_seorank->link}} target="_blank">{{$data_seorank->link}}</a></th>
                                                    @if ($data_seorank->moz != null && $data_seorank->semrush != null && $data_seorank->ahrefs != null)
                                                    <td>{{$moz->da}}</td>
                                                    <td>{{$moz->pa}}</td>
                                                    <td>{{$moz->mozrank}}</td>
                                                    <td>{{$moz->links}}</td>
                                                    <td>{{$moz->equity}}</td>
                                                    <td>{{$semrush->sr_domain}}</td>
                                                    <td>{{$semrush->sr_rank}}</td>
                                                    <td>{{$semrush->sr_kwords}}</td>
                                                    <td>{{$semrush->sr_traffic}}</td>
                                                    <td>{{$semrush->sr_costs}}</td>
                                                    <td>{{$semrush->sr_ulinks}}</td>
                                                    <td>{{$semrush->sr_hlinks}}</td>
                                                    <td>{{$semrush->sr_dlinks}}</td>
                                                    <td>{{$facebook->fb_comments}}</td>
                                                    <td>{{$facebook->fb_shares}}</td>
                                                    <td>{{$facebook->fb_reac}}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div> <!-- end .table-responsive -->
                                    <button type="submit">Lấy dữ liệu từ Seo-rank hôm nay</button>
                                </div> <!-- end .table-rep-plugin-->
                            </div> <!-- end .responsive-table-plugin-->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection
@section('js')

   <!-- Responsive Table js -->
   <script src=" {{asset('assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>

   <!-- Init js -->
   <script src=" {{asset('assets/js/pages/responsive-table.init.js') }}"></script>

@endsection
