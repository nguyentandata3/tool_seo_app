<?php
    $projects = DB::table('tool_cms_projects')->ORDERBY('id', 'DESC')->get();

?>
<!--- Sidemenu -->
<div id="sidebar-menu">
    <ul id="side-menu">
        @foreach ($projects as $key_project => $project)
        <li>
            <a href="#sidebarMultilevel{{$key_project}}" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2">
                    <circle cx="18" cy="5" r="3"></circle>
                    <circle cx="6" cy="12" r="3"></circle>
                    <circle cx="18" cy="19" r="3"></circle>
                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                </svg>
                <span>{{$project->name}}</span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarMultilevel{{$key_project}}" style="">
                <ul class="nav-second-level">
                    <?php $keywords = DB::table('tool_cms_keywords')->where('project_id', $project->id)->ORDERBY('id', 'DESC')->get(); ?>
                    @foreach ($keywords as $key_keyword => $keyword)
                    <li>
                        <a href={{route('serprobot.get_seorank',['project_id' => $project->id, 'keyword_id' => $keyword->id])}}>{{$keyword->keyword}} </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </li>
        @endforeach
    </ul>

</div>
<!-- End Sidebar -->
