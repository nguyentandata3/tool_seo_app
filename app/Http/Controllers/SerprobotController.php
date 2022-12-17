<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SerprobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('serprobot.index');
    }

    public function get_apikey()
    {
        return view('serprobot.apikey');
    }
    public function post_apikey(Request $request)
    {
        $apikey = $request->apikey;
        $url_project = "https://api.serprobot.com/v1/api.php?api_key=$apikey&action=list_projects";
        $projects = (json_decode(file_get_contents($url_project),true));
        DB::table('users')->where('uuid', );
        foreach ($projects as $key_project => $value) {
            $data_project['project_id'] = $value['id'];
            $data_project['name'] = $value['name'];
            $data_project['region'] = $value['region'];
            $data_project['url'] = $value['url'];
            $data_project['created_at'] = $value['created'];
            $data_project['number_of_keywords'] = $value['number_of_keywords'];
            $data_project['competitors'] = json_encode($value['competitors']);
            $data_project['notes'] = $value['notes'];
            $data_project['tags'] = json_encode($value['tags']);
            $data_project['user_id'] = 1;
            DB::table('tool_cms_projects')->insert($data_project);
            $project_id = DB::table('tool_cms_projects')->ORDERBY('id', 'DESC')->first()->id;
            $url_keywords = "https://api.serprobot.com/v1/api.php?api_key=b2c40bfc55161461279f9fe89089e1a0&action=project&project_id=$value[id]";
            $data_keywords = json_decode(file_get_contents($url_keywords));
            $data_keywords = $data_keywords->keywords;
            foreach($data_keywords as $key_keyword => $keyword) {
                $data_keyword['serprobot_keyword_id'] = $keyword->id;
                $data_keyword['keyword'] = $keyword->keyword;
                $data_keyword['first_position'] = $keyword->first_position;
                $data_keyword['best_position'] = $keyword->best_position;
                $data_keyword['current_position'] = $keyword->current_position;
                $data_keyword['latest_change'] = $keyword->latest_change;
                $data_keyword['latest_found_serp'] = $keyword->latest_found_serp;
                $data_keyword['created_at'] = $keyword->created;
                $data_keyword['last_checked'] = $keyword->last_checked;
                $data_keyword['project_id'] = $project_id;
                DB::table('tool_cms_keywords')->insert($data_keyword);
                $keyword_id = DB::table('tool_cms_keywords')->ORDERBY('id', 'DESC')->first()->id;
                $url_data_serprobot = "https://api.serprobot.com/v1/api.php?api_key=b2c40bfc55161461279f9fe89089e1a0&action=keyword&keyword_id=$data_keyword[serprobot_keyword_id]";
                $data_serprobots = json_decode(file_get_contents($url_data_serprobot));
                $data_serprobots = $data_serprobots->check_data;
                foreach($data_serprobots as $key_serprobot => $serprobot ) {
                    $data_serprobot['serprobot_id'] = $serprobot->id;
                    $data_serprobot['position'] = $serprobot->position;
                    $data_serprobot['link_top_10'] = json_encode($serprobot->top_serps);
                    $data_serprobot['keyword_id'] = $keyword_id;
                    $data_serprobot['created_at'] = $serprobot->created;
                    $data_serprobot['found_serp'] = $serprobot->found_serp;
                    $data_serprobot['competition_details'] = json_encode($serprobot->competition_details);
                    DB::table('tool_cms_data_serprobots')->insert($data_serprobot);
                    $serprobot_id = DB::table('tool_cms_data_serprobots')->ORDERBY('id', 'DESC')->first()->id;
                    foreach($serprobot->top_serps as $key_top10 => $value) {
                        $data_seorank['link'] = $value;
                        $data_seorank['created_at'] = $data_serprobot['created_at'];
                        $data_seorank['data_serprobot_id'] = $serprobot_id;
                        DB::table('tool_cms_data_seoranks')->insert($data_seorank);
                    }
                }
            }
        }

        return redirect()->route('serprobot.index')->with(['success' => "Thêm key: $apikey thành công"]);
    }

    public function get_project($project_id)
    {
        $data['projects'] = DB::table('tool_cms_projects')->where('project_id', $project_id)->get();
        return view('Serprobot.project', $data);
    }

    public function get_seorank($project_id, $keyword_id)
    {
        // $data['exams'] = DB::table('exams')
        //     ->select('exams.*', 'subjects.name as subject_name')
        //     ->join('subjects', 'exams.subject_id', '=', 'subjects.id')
        //     ->ORDERBY('id', 'DESC')
        //     ->where('subject_id', $subject_id)
        //     ->get();
        $data['serprobots'] = DB::table('tool_cms_data_serprobots')
            ->select('tool_cms_data_serprobots.*', 'tool_cms_keywords.keyword as keyword_keyword')
            ->join('tool_cms_keywords', 'tool_cms_data_serprobots.keyword_id', '=', 'tool_cms_keywords.id')
            ->where('keyword_id', $keyword_id)
            ->get();
        $data['keyword'] = DB::table('tool_cms_keywords')->where('id', $keyword_id)->first();
        return view('Serprobot.show_seorank', ['data' => $data]);
    }

    public function post_seorank(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function keyword()
    {
        return view('serprobot.keyword');
    }

    public function apikey()
    {
        return view('serprobot.apikey');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_(Request $request)
    {
        $key_api = 'e241bf657e18550918b0c47d5fcf63f7';
        $keyword = str_replace(" ", "%20", $request->keyword);
        $url = "https://api.serprobot.com/v1/api.php?api_key=$key_api&action=rank_check&region=www.google.com.vn&keyword=$keyword&target_url=$request->domain&device=mobile&competitors[]=facebook.com&competitors[]=example.com&hl=en";
        $new_data = (file_get_contents($url));
        $new_data = json_decode($new_data);
        $data['keyword'] = $request->keyword;
        $data['domain'] = $request->domain;
        $data['region'] = 'google.com.vn';
        $data['position'] = $new_data->pos;
        $data['found_serp'] = $new_data->found_serp;
        $data['top10'] = json_encode($new_data->serps);
        $data['user_id'] = 1;
        $data['created_at'] = new \DateTime;
        DB::table('serprobots')->insert($data);
        $seorank = DB::table('serprobots')->ORDERBY('id', 'DESC')->first();
        $url_seorank = "https://seo-rank.my-addr.com/api2/moz+sr+fb/EC2B9F19F09F27C0757D6F8281B4414B/$request->domain";
        $new_data_seorank1 = json_decode(file_get_contents($url_seorank));
            $data_seorank1['link'] = $request->domain;
            $data_seorank1['core_domain'] = 2;
            $data_seorank1['moz'] = json_encode([
                'da' => $new_data_seorank1->da,
                'pa' => $new_data_seorank1->pa,
                'mozrank' => $new_data_seorank1->mozrank,
                'links' => $new_data_seorank1->links,
                'equity' => $new_data_seorank1->equity
            ]);
            $data_seorank1['semrush'] = json_encode([
                'sr_domain' => $new_data_seorank1->sr_domain,
                'sr_rank' => $new_data_seorank1->sr_rank,
                'sr_kwords' => $new_data_seorank1->sr_kwords,
                'sr_traffic' => $new_data_seorank1->sr_traffic,
                'sr_costs' => $new_data_seorank1->sr_costs,
                'sr_ulinks' => $new_data_seorank1->sr_ulinks,
                'sr_hlinks' => $new_data_seorank1->sr_hlinks,
                'sr_dlinks' => $new_data_seorank1->sr_dlinks
            ]);
            $data_seorank1['facebook'] = json_encode([
                'fb_comments' => $new_data_seorank1->fb_comments,
                'fb_shares' => $new_data_seorank1->fb_shares,
                'fb_reac' => $new_data_seorank1->fb_reac,
            ]);
            $data_seorank1['serprobot_id'] = $seorank->id;
            $data_seorank1['created_at'] = new \DateTime;
            DB::table('seoranks')->insert($data_seorank1);
        $top10 = json_decode($seorank->top10);
        foreach($top10 as $key => $value) {
            $url_seorank = "https://seo-rank.my-addr.com/api2/moz+sr+fb/EC2B9F19F09F27C0757D6F8281B4414B/$value";
            $new_data_seorank = json_decode(file_get_contents($url_seorank));
            $data_seorank['link'] = $value;
            $data_seorank['moz'] = json_encode([
                'da' => $new_data_seorank->da,
                'pa' => $new_data_seorank->pa,
                'mozrank' => $new_data_seorank->mozrank,
                'links' => $new_data_seorank->links,
                'equity' => $new_data_seorank->equity
            ]);
            $data_seorank['semrush'] = json_encode([
                'sr_domain' => $new_data_seorank->sr_domain,
                'sr_rank' => $new_data_seorank->sr_rank,
                'sr_kwords' => $new_data_seorank->sr_kwords,
                'sr_traffic' => $new_data_seorank->sr_traffic,
                'sr_costs' => $new_data_seorank->sr_costs,
                'sr_ulinks' => $new_data_seorank->sr_ulinks,
                'sr_hlinks' => $new_data_seorank->sr_hlinks,
                'sr_dlinks' => $new_data_seorank->sr_dlinks
            ]);
            $data_seorank['facebook'] = json_encode([
                'fb_comments' => $new_data_seorank->fb_comments,
                'fb_shares' => $new_data_seorank->fb_shares,
                'fb_reac' => $new_data_seorank->fb_reac,
            ]);
            $data_seorank['serprobot_id'] = $seorank->id;
            $data_seorank['created_at'] = new \DateTime;
            DB::table('seoranks')->insert($data_seorank);
            if($key == 4) {
                return redirect()->route('serprobot.seorank', ['_token' => $request->token, 'top10' => $top10]);
            }
        }
    }

    public function seorank(Request $request)
    {
        $id = DB::table('serprobots')->ORDERBY('id', 'DESC')->first()->id;
        $top10 = $request->top10;
        foreach($top10 as $key => $value) {
            if($key <= 4) {
                continue;
            }
            $url_seorank = "https://seo-rank.my-addr.com/api2/moz+sr+fb/EC2B9F19F09F27C0757D6F8281B4414B/$value";
            $new_data_seorank = json_decode(file_get_contents($url_seorank));
            $data_seorank['link'] = $value;
            $data_seorank['moz'] = json_encode([
                'da' => $new_data_seorank->da,
                'pa' => $new_data_seorank->pa,
                'mozrank' => $new_data_seorank->mozrank,
                'links' => $new_data_seorank->links,
                'equity' => $new_data_seorank->equity
            ]);
            $data_seorank['semrush'] = json_encode([
                'sr_domain' => $new_data_seorank->sr_domain,
                'sr_rank' => $new_data_seorank->sr_rank,
                'sr_kwords' => $new_data_seorank->sr_kwords,
                'sr_traffic' => $new_data_seorank->sr_traffic,
                'sr_costs' => $new_data_seorank->sr_costs,
                'sr_ulinks' => $new_data_seorank->sr_ulinks,
                'sr_hlinks' => $new_data_seorank->sr_hlinks,
                'sr_dlinks' => $new_data_seorank->sr_dlinks
            ]);
            $data_seorank['facebook'] = json_encode([
                'fb_comments' => $new_data_seorank->fb_comments,
                'fb_shares' => $new_data_seorank->fb_shares,
                'fb_reac' => $new_data_seorank->fb_reac,
            ]);
            $data_seorank['serprobot_id'] = $id;
            $data_seorank['created_at'] = new \DateTime;
            DB::table('seoranks')->insert($data_seorank);
            if($key == 4) {
                return redirect()->route('serprobot.seorank', ['_token' => $request->token, 'top10' => $top10]);
            }
        }
        return redirect()->route('serprobot.show', ['id' => $id])->with(['success' => 'Tạo dự án mới thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_serprobot = DB::table('serprobots')->where('id', $id)->first();
        $data_seoranks = DB::table('seoranks')->where('serprobot_id', $id)->get();
        return view('serprobot.show', ['data_serprobot' => $data_serprobot, 'data_seoranks' => $data_seoranks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
