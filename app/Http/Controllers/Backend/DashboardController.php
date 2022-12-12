<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Illuminate\Http\Request;

use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

use DB;
use App\Models\Counter;
use Session;


class DashboardController extends ShareController
{
    public function index()
    {
		if(session('locale') == null)
		Session::put('locale', 'vi');
				 $month_of_year =  Carbon::now()->month;
		  $year =  Carbon::now()->year;
		  if ($month_of_year < 10) {
			  $get_month = Carbon::now()->month;
			  $month = '0'.$get_month;
		  }else {
			  $month =  Carbon::now()->month;
		  }
		  return view('backend.dashboard',compact('month','year'));
  
  		// Total visitors and pageviews
		// public function fetchTotalVisitorsAndPageViews(Period $period): Collection
  		// $data = [];
		// $fetchTotalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days(6));
		// $data["date"] = $fetchTotalVisitorsAndPageViews->pluck("date");
		// $data["visitors"] = $fetchTotalVisitorsAndPageViews->pluck("visitors");
		// $data["pageViews"] = $fetchTotalVisitorsAndPageViews->pluck("pageViews");
		// $date = json_encode($fetchTotalVisitorsAndPageViews->pluck("date"));
		// $dateOne = date('d/m/Y',strtotime("-0 days"));
		// $dateTwo = date('d.m.Y',strtotime("-1 days"));
		// $dateThree = date('d.m.Y',strtotime("-2 days"));
		// $dateFour = date('d.m.Y',strtotime("-3 days"));
		// $dateFive = date('d.m.Y',strtotime("-4 days"));
		// $dateSix = date('d.m.Y',strtotime("-5 days"));
		// $dateSevent = date('d.m.Y',strtotime("-6 days"));
		// $dateArrays = [$dateSevent,$dateSix,$dateFive,$dateFour,$dateThree,$dateTwo,$dateOne];
		// dd($dateArrays);

		// $visitors = json_encode($data["visitors"] = $fetchTotalVisitorsAndPageViews->pluck("visitors"));
		// $pageViews = json_encode($data["pageViews"] = $fetchTotalVisitorsAndPageViews->pluck("pageViews"));

		// $dates = date('Y-m-d',strtotime($date));
		// $array[] = $Store; 

		// dd($bar);
		// $data_date_format = $data_date->format('Y-m-d');
		// dd($data_date_format);

		// dd($data_date);

		// $date = json_encode($data["date"]);
		// dd($date);
		
		// dd($fetchTotalVisitorsAndPageViews);

    	//fetch the most visited pages for today and the past week
    	// $data = Analytics::fetchMostVisitedPages(Period::days(7));
    	// $date1 = json_encode($data["visitors"]);
		// dd($date1);


    	//fetch visitors and page views for the past week
		// $fetchVisitorsAndPageViews = Analytics::fetchVisitorsAndPageViews(Period::days(1));
		// dd($fetchVisitorsAndPageViews);
		
		//retrieve visitors and pageview data for the current day and the last seven days
		// $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(1));
		
		// Ngày này của năm trước
		// $startDate = Carbon::now()->subYear();
		// Ngày hiện tại
		// $endDate = Carbon::now();
		// fetchTopBrowsers(Period::days(7), int $maxResults = 10);
		// $data3 = fetchVisitorsAndPageViews();

		// $trinhduyet = Analytics::fetchTopBrowsers(Period::days(7), $maxResults = 10);

		// $fetchUserTypes = Analytics::fetchUserTypes(Period::days(7));
		// public function fetchUserTypes(Period $period): Collection
		
		// public function fetchTopReferrers(Period $period, int $maxResults = 20): Collection

		// $fetchTopReferrers = Analytics::fetchTopReferrers(Period::days(7), $maxResults = 10);

        // return view('backend.dashboard',compact('date','visitors','pageViews','dateArrays','dateOne'));
        return view('backend.dashboard');
    }

	public function counter(){
		$month =  Carbon::now()->month;
		$year =  Carbon::now()->year;
		$get_all_colum_counter =  Counter::select('id','time', DB::raw("DATE_FORMAT(time, '%d') days"))
		->where(DB::raw("DATE_FORMAT(time, '%Y')"),'=',$year)
		->where(DB::raw("DATE_FORMAT(time, '%m')"),'=',$month)
		->get()
		->groupBy('days');
		$count_day_duplicate = [];
		$count_day = [];
		foreach ($get_all_colum_counter as $key => $value) {
			$count_day_duplicate[(int)$key] = count($value);
		}
		for($i = 1; $i <= Carbon::now()->daysInMonth; $i++){
			if(!empty($count_day_duplicate[$i])){
				$count_day[$i] = $count_day_duplicate[$i];
			}else{
				$count_day[$i] = 0;
			}
			$respon[] = array($i, $count_day[$i]);
		}
		return response()->json($respon);
	}

	public function shortday(Request $resquest){
		$month = $resquest->get('getmonth');
		$year = $resquest->get('getyear');
		$timeget = "$year-$month";
		$get_short_colum_counter =  Counter::select('id','time', DB::raw("DATE_FORMAT(time, '%d') days"))
		->where(DB::raw("DATE_FORMAT(time, '%Y')"),'=',$year)
		->where(DB::raw("DATE_FORMAT(time, '%m')"),'=',$month)
		->get()
		->groupBy('days');
		$short_count_day_duplicate = [];
		$short_count_day = [];
		foreach ($get_short_colum_counter as $keyz => $valueshort) {
			$short_count_day_duplicate[(int)$keyz] = count($valueshort);
		}
		for($i = 1; $i <= Carbon::create($year,$month,1)->daysInMonth; $i++){
			if(!empty($short_count_day_duplicate[$i])){
				$short_count_day[$i] = $short_count_day_duplicate[$i];
			}else{
				$short_count_day[$i] = 0;
			}
			$response[] = array($i, $short_count_day[$i]);
		}
		return response()->json($response);
	}
}