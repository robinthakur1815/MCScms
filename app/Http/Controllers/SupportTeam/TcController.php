<?php

namespace App\Http\Controllers\SupportTeam;

use App\Models\Tc;
use App\Helpers\Qs;
use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Repositories\MyClassRepo;
use App\Repositories\StudentRepo;
use Illuminate\Http\Request;

class TcController extends Controller
{

    protected $my_class, $student;

    public function __construct(MyClassRepo $my_class, StudentRepo $student)
    {
        $this->middleware('teamSA');

        $this->my_class = $my_class;
        $this->student = $student;
    }
    public function promotion($fc = NULL)
    {
        $d['old_year'] = $old_yr = Qs::getSetting('current_session');
        $old_yr = explode('-', $old_yr);
        $d['my_classes'] = $this->my_class->all();
      
        if($fc){
            $d['selected'] = true;
            $d['fc'] = $fc;
            $d['students'] = $sts = $this->student->getRecord(['my_class_id' => $fc, $d['old_year']])->get();
            if($sts->count() < 1){
                return redirect()->route('students.tc')->with('flash_success', __('msg.nstp'));
            }
        }

        return view('pages.support_team.students.tc.index', $d);
    }

    public function promote(Request $req, $fc, $fs, $tc, $ts)
    {
        $oy = Qs::getSetting('current_session'); $d = [];
        $old_yr = explode('-', $oy);
        $ny = ++$old_yr[0].'-'.++$old_yr[1];
        $students = $this->student->getRecord(['my_class_id' => $fc, 'section_id' => $fs, 'session' => $oy ])->get()->sortBy('user.name');

        if($students->count() < 1){
            return redirect()->route('students.promotion')->with('flash_danger', __('msg.srnf'));
        }

        foreach($students as $st){
            $this->student->updateRecord($st->id, $d);

//            Insert New Promotion Data
            $promote['from_class'] = $fc;
            $promote['student_id'] = $st->user_id;
            $promote['from_session'] = $oy;
            $promote['to_session'] = $ny;
            // $promote['status'] = $p;

            $this->student->createPromotion($promote);
        }
        return redirect()->route('students.promotion')->with('flash_success', __('msg.update_ok'));
    }
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tc  $tc
     * @return \Illuminate\Http\Response
     */
    public function show(Tc $tc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tc  $tc
     * @return \Illuminate\Http\Response
     */
    public function edit(Tc $tc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tc  $tc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tc $tc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tc  $tc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tc $tc)
    {
        //
    }
}
