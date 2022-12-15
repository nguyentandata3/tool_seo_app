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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
