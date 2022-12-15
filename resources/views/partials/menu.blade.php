<?php
    $data_cms_serprobot = DB::table('serprobots')
        ->ORDERBY('id', 'DESC')
        ->get();
    $amount_serprobot = DB::table('serprobots')->count();

    $data_cms_seorank = DB::table('seoranks')
        ->ORDERBY('id', 'DESC')
        ->get();
    $amount_seorank = DB::table('seoranks')->count();
?>

<!--- Sidemenu -->
<div id="sidebar-menu">
    <ul id="side-menu">
        <li>
            <a href="#sidebarDashboards" data-bs-toggle="collapse">
                <i data-feather="airplay"></i>
                <span class="badge bg-success rounded-pill float-end">{{$amount_serprobot}}</span>
                <span> Serprobot </span>
            </a>
            <div class="collapse" id="sidebarDashboards">
                <ul class="nav-second-level">
                @foreach($data_cms_serprobot as $key => $value)
                    <li>
                        <a href="{{route('serprobot.show', ['id' => $value->id])}}">{{$value->keyword}} ({{date('d/m/Y', strtotime($value->created_at))}})</a>
                    </li>
                @endforeach
                </ul>
            </div>
        </li>
    </ul>

</div>
<!-- End Sidebar -->
