<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
Use Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getData(Request $request)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://dev3.dansmultipro.co.id/api/recruitment/positions.json?description='.$request->filter_description.'&location='.$request->filter_location.'');
        $responseContent = $response->getBody()->getContents();
        $data = json_decode($responseContent);
        $bulan_convert = [];
        foreach (['01','02','03','04','05','06','07','08','09','10','11','12'] as $key => $value) {
            $date= Carbon::parse('2021-'.$value.'-01', 'UTC');
            $bulan_convert[$date->isoFormat('MMM')] = $value;
        }
        if ($request->filter_fulltime == "1") {
            $datanew = [];
            foreach ($data as $key => $value) {
                if ($value->type == 'Full Time') {
                    $datanew[$key] = $value;
                }
            }
            $data = $datanew;
        }
        return datatables()->of($data)
        ->addColumn('information', function($row) use ($bulan_convert){
            $tahun      = substr($row->created_at,24,4);
            $bulan      = $bulan_convert[substr($row->created_at,4,3)];
            $tanggal    = substr($row->created_at,8,2);
            $waktu      = substr($row->created_at,11,8);
            $locale     = substr($row->created_at,20,3);
            $time       = $tahun.'-'.$bulan.'-'.$tanggal.' '.$waktu.', '.$locale;
           return '
            <a href="'.route("detail",$row->id).'" class="media">
                <div class="media-body">
                    <div class="media-title font-weight-bold">'.$row->title.'</div>
                    <span class="font-weight-normal text-dark">'.$row->company.' - </span>
                    <span class="text-success">'.$row->type.'</span>
                </div>
                <div class="align-self-center ml-3 text-right text-dark">
                    <span class="font-weight-semibold">'.$row->location.'</span>
                    <br>
                    <span class="font-weight-light">'.Carbon::parse($time)->diffForHumans().'</span>
                </div>
            </a>
                ';
          })
        ->addIndexColumn()
        ->rawColumns(['information'])
        ->make(true);
    }

    public function detail($id)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://dev3.dansmultipro.co.id/api/recruitment/positions/'.$id);
        $responseContent = $response->getBody()->getContents();
        $data = json_decode($responseContent);
        return view('job-detail', compact('data'));
    }
}
