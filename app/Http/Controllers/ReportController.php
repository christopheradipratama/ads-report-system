<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\ReportRequest;
use App\Http\Requests\ReporterRequest;
use App\Http\Requests\VerificationRequest;
use App\Models\Report;
use App\Models\Reporter;
use App\Models\ReportTracker;
use App\Models\Categories;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Activitylog\Models\Activity;


class ReportController extends Controller
{
        /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function index_create(){
        return view('report/create-report');
    }

    public function index(){
        if (request()->ajax()) {
            $reports = Report::leftJoin('categories', 'reports.category_id', '=', 'categories.id')
                ->select('reports.*', 'categories.name as category_name')
                ->get();
    
            foreach ($reports as $report) {
                $report->image_url = $report->getFirstMediaUrl('image');
            }
    
            return DataTables::of($reports)
                ->addIndexColumn()
                ->addColumn('reporter_name', function ($item) {
                    return $item->reporter->name;
                })
                ->addColumn('category_name', function ($item) {
                    return $item->category_name ?: 'Belum Dikategorikan';
                })
                ->addColumn('image', function ($item) {
                    return $item->image_url;
                })
                ->addColumn('action', function ($item) {
                    $verification_report = url('/verification-report/' . $item->id);
                    $reports_log = url('/report-log/' . $item->id);
                    $button = '<div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="' .$verification_report. '">Verify</a></li>
                                    <li><a class="dropdown-item" href="' .$reports_log. '">Log</a></li>
                                </ul>
                            </div> ';
                    return $button;
                })
                ->make();
        }
        return view('report/report-index');
    }
    

    function generateTicketId(){
        $year = date('Y');
        $month = date('m');
        $day = date('d');

        $lastTicket = Report::latest('ticket_id')->first();

        if ($lastTicket) {
            $lastTicketId = $lastTicket->id;
            $lastTicketNumber = intval(substr($lastTicketId, -5));
            $newTicketNumber = str_pad($lastTicketNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $newTicketNumber = '00001';
        }

        $ticketId = $year . $month . $day . $newTicketNumber;

        return $ticketId;
    }


    public function store(ReportRequest $ReportRequest, ReporterRequest $ReporterRequest){
        $reporter = Reporter::create($ReporterRequest->validated());
        $reportData = $ReportRequest->validated();
        $reportData['reporter_id'] = $reporter->id;
        $reportData['category_id'] = null;
        $reportData['ticket_id'] = $this->generateTicketId();
        $reportData['status'] = 'Pending';
        $report = Report::create($reportData);
        $report->addMediaFromRequest('image')->toMediaCollection('image');
        
        return redirect()->intended('/');
    }
    
    
    public function verification($id){
        $report = Report::where('id', $id)->first();
        $categories = Categories::all();
        
        return view('report/verification-report')->with([
           'report' => $report,
           'categories' => $categories
        ]);
    }

    public function verify(VerificationRequest $VerificationRequest, $id){
        $report = Report::where('id', $id)->first();

        $report = Report::findOrFail($id);

        $report->category_id = $VerificationRequest->category_id;
        $report->status = $VerificationRequest->status;
    
        $report->save();
        
        $report_trackers = $VerificationRequest->validated();
        $report_trackers['user_id'] = $report->reporter_id;
        $report_trackers['report_id'] = $id;
        $report_trackers['status'] = $VerificationRequest->status;
        $report_trackers['note'] = $VerificationRequest->note;

        $report_tracker = ReportTracker::create($report_trackers);

        return redirect()->intended('/report-trackers');
    }

    public function index_report_trackers(){
        if (request()->ajax()) {   
            $report_trackers = ReportTracker::join('reports', 'report_trackers.user_id', '=', 'reports.reporter_id')
            ->join('reporters', 'reports.reporter_id', '=', 'reporters.id')
            ->select('report_trackers.*', 'reporters.name as user_name')
            ->get();
            
            return DataTables::of($report_trackers)
                ->addIndexColumn()
                ->addColumn('user_name', function ($item) {
                    return $item->user_name;
                })
                ->make();
        }
        return view('report/report-trackers');
    }

    public function log(Report $report){
        return view('report/report-log',[
            'logs' => Activity::where('subject_type', Report::class)
            ->where('subject_id',$report->id)
            ->latest()
            ->get()
        ]);
    }
}