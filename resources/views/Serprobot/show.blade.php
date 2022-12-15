@extends('master')
@section('css')
  <link rel="shortcut icon" href=" {{asset('assets/images/favicon.ico') }}" />
  <link href=" {{asset('assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />
  <link href=" {{asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href=" {{asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
  <link href=" {{asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
  <script src=" {{asset('assets/js/head.js') }}"></script>
@endsection
@section('content')

<div>Keyword: {{$data_serprobot->keyword}}</div>
<div>Domain: <a href="http://{{$data_serprobot->domain}}">{{$data_serprobot->domain}}</a></div>
<div>Position: {{$data_serprobot->position ? $data_serprobot->position : 'Not found in top 100'}}</div>
<div>Found serps: {{$data_serprobot->found_serp ? $data_serprobot->found_serp : 'Not found in top 100'}}</div>
<div>Region: {{$data_serprobot->region}}</div>
<div>Days: {{ date('d/m/Y', strtotime($data_serprobot->created_at)) }}</div>
<div>Top 10: </div>
      <div class="row">
       <div class="col-12">
        <div class="card">
         <div class="card-body">
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
              <tbody>
                @foreach ($data_seoranks as $key => $value)
                    <?php
                    $moz = json_decode($value->moz);
                    $semrush = json_decode($value->semrush);
                    $facebook = json_decode($value->facebook); ?>
               <tr>
                <th><a href={{$value->link}} target="_blank">{{$value->link}}</a></th>
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
               </tr>
                @endforeach
            </tbody>
             </table>
            </div>
            <!-- end .table-responsive -->
           </div>
           <!-- end .table-rep-plugin-->
          </div>
          <!-- end .responsive-table-plugin-->
         </div>
        </div>
        <!-- end card -->
       </div>
       <!-- end col -->
      </div>
      <!-- end row -->
@endsection
@section('js')
  <!-- Vendor js -->
  <script src=" {{asset('assets/js/vendor.min.js') }}"></script>

  <!-- Responsive Table js -->
  <script src=" {{asset('assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>

  <!-- Init js -->
  <script src=" {{asset('assets/js/pages/responsive-table.init.js') }}"></script>

  <!-- App js -->
  <script src=" {{asset('assets/js/app.min.js') }}"></script>
@endsection
