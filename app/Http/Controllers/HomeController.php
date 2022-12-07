<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Calendar;

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

    public function top(Request $request)
    {
        $role=Auth::User()->role;

        if($role===0){
            $uid = Auth::User()->id;
            $mymeds = DB::table('meds')
                    ->select('id','user_id','name','days','amount','type','comments','time','date_of_creation','date_of_update','del_flag')
                    ->where('user_id','=',$uid)
                    ->where('del_flag','=',0)
                    ->get();
            $session = $request->session()->all();
            // var_dump($mymeds);
            return view('medapp.patienttop',['mymeds' => $mymeds]);
        }elseif($role === 1){
            $uid = Auth::User()->id;
            $keyword = $request->input('keyword');
            
            if(!empty($keyword)){

                $mypatients = DB::table('patients')
                        ->leftJoin('users','patients.patientid','=','users.id')
                        ->select('users.name','users.id','users.email','users.created_at')
                        ->where([
                            ['doctorid','=',$uid],
                            ['users.name','LIKE', "%{$keyword}%"]
                            ])
                        ->orWhere([
                            ['doctorid','=',$uid],
                            ['users.email','LIKE', "%{$keyword}%"]
                            ])
                        ->orWhere([
                            ['doctorid','=',$uid],
                            ['users.id','LIKE', "%{$keyword}%"]
                            ])
                        ->get();
                $session = $request->session()->all();
                return view('medapp.doctop',['mypatients' => $mypatients, 'keyword' => $keyword ]);

                
            } else {
                $keyword = "";
                $mypatients = DB::table('patients')
                        ->leftJoin('users','patients.patientid','=','users.id')
                        ->select('users.name', 'users.id', 'users.email', 'users.created_at')
                        ->where('doctorid','=',$uid)
                        ->get();
                $session = $request->session()->all();
                return view('medapp.doctop',['mypatients' => $mypatients, 'keyword' => $keyword]);
            }

        }elseif($role === 2){
            $users = DB::table('users')
                    ->select('id','email','role', 'created_at')
                    ->where('role','!=',2)
                    ->get();
            $session = $request->session()->all();
            return view('medapp.admintop', ['users' => $users]);
        }
    }

    //患者の薬袋を表示

    public function show(Request $request, $id)
    {
        $name = $request->get("patientname");
        $mymeds = DB::table('meds')
                    ->leftJoin('users','meds.user_id','=','users.id')
                    ->select('meds.id','users.name AS uname','meds.user_id','meds.name','meds.days','meds.amount','meds.type','meds.comments','meds.time','meds.date_of_creation','meds.date_of_update','meds.del_flag')
                    ->where('user_id','=',$id)
                    ->where('del_flag','=',0)
                    ->get();
        $session = $request->session()->all();
        // var_dump($mymeds);
        return view('medapp.viewpatient',['mymeds' => $mymeds, 'patientname' => $name]);
    }

    //プロフィール

    public function mydash(Request $request)
    {
        $role=Auth::User()->role;

        //一般ユーザプロフィール

        if($role===0){
            $uid = Auth::User()->id;
            $mydoctors = DB::table('patients')
                        ->leftJoin('users','patients.doctorid','=','users.id')
                        ->select('users.name','users.email', 'users.profile_photo_path')
                        ->where('patientid','=',$uid)
                        ->get();
            $session = $request->session()->all();
            return view('medapp.patientprofile',['mydoctors' => $mydoctors]);

        //医療関係者プロフィール

        }elseif($role === 1){
            $uid = Auth::User()->id;
            $mypatients = DB::table('patients')
                        ->leftJoin('users','patients.patientid','=','users.id')
                        ->select('users.name', 'users.email','users.profile_photo_path')
                        ->where('doctorid','=',$uid)
                        ->get();
            $session = $request->session()->all();
            return view('medapp.docprofile',['mypatients' => $mypatients]);
        }elseif($role === 2){
            return view('medapp.admintop');
        }
    }

    //薬追加内容確認画面が直接アクセスされた場合

    public function confirm ()
    {
        return redirect('add');
    }

    private $keys = ['id', 'user_id', 'name', 'days', 'amount', 'type', 'time', 'comments','date_of_creation'];

    public function addconfirm(Request $request)
    {
        $input = $request->all($this->keys);
        $request->session()->put("input", $input);
        return view('medapp.addconfirm', ["input" => $input]);
    }

    
    public function send(Request $request)
    {
   
        $uid = Auth::User()->id;
        $input = $request->session()->get('input');
        $days = implode('、', $input['days']);
        $time = implode('、', $input['time']);

        if($request->has("con_cancel"))
        {
            return redirect('add')->withInput($input);
        }elseif($request->has('finalize')){

            if(!$input)
            {
                return redirect('add');
            }else{
                DB::table('meds')->insert([
                    'user_id' => $uid,
                    'name' => $input['name'],
                    'days' => $days,
                    'amount' => $input['amount'],
                    'type' => $input['type'],
                    'time' => $time,
                    'comments' => $input['comments'],
                    'date_of_creation' => Carbon::now()
                ]);
            }
            $request->session()->forget('input');
        }
        return redirect()->route("top");
    }

    public function edit(Request $request, $id)
    {
        
        $meds = DB::table('meds');
        $data = $meds->find($id);
        // var_dump($data);
        return view('medapp.edit', ['data' => $data]);
        
    }
    
    public function finishEditGET(){
        
        return redirect()->route('top');
    }

    public function finishEdit(Request $request, $id)
    {
        $role = Auth::User()->role;

        if($role === 0)
        {
            return redirect()->route('top');
        }
        elseif($role === 1)
        {
            return redirect()->route('show', ['id' => $id]);
        }

    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        
        if(!empty($date)){
            return redirect()->route("top");
        } else {
            $meds = DB::table('meds');
            $data = $meds->find($id);

            $meds->update([
                'name' => $request['name'],
                'amount' => $request['amount'],
                'type' => $request['type'],
                'comments' => $request['comments'],
                'date_of_update' => Carbon::now()
            ]);

            if(isset($request['days'])){
                $meds->update([
                    'days' => implode('、', $request['days'])
                ]);
            }

            if(isset($request['time'])){
                $meds->update([
                    'time' => implode('、', $request['time'])
                ]);
            }

        }
        return redirect()->route('top');
    }

    public function delete()
    {
        return redirect()->route('top');
    }

    public function deletePOST($id)
    {
        $meds = DB::table('meds');
        $meds->find($id);

        $meds->update([
            'del_flag' => 1
        ]);

        return redirect()->route('top');
    }

    public function deleteUserGET()
    {
        return redirect()->route('top');
    }

    public function deleteUser($id)
    {
        $users = DB::table('users');
        $users->where('id',$id)->delete();
        return redirect()->route('top');
    }

    public function addPatientGET()
    {
        return redirect()->route('top');
    }

    public function addPatient(Request $request)
    {
        $docID = Auth::User()->id;
        $input = $request->get('patient_id');
        var_dump($input);

        if(!isset($input))
        {
            return redirect()->route('top');
            
        }
        else
        {
            DB::table('patients')->insert([
                'patientid' => $input,
                'doctorid' => $docID
            ]);
        }
        return redirect()->route('dashboard');
        
    }

    public function removePatientGET()
    {
        return redirect()->route('top');
    }

    public function removePatient($id)
    {
        $patients = DB::table('patients');
        $patients->where('patientid',$id)->delete();
      
        return redirect()->route('top');
    }

    public function pictureUpdate(Request $request, $id)
    {
        $data = $request->all();

        if($request->profile_photo !== null)
        {
            $profileImagePath = $request->profile_photo->store('public/profiles');

            var_dump($profileImagePath);

            $users = DB::table('users');
            $data = $users->find($id);

            $users->update([
                'profile_photo_path' => $profileImagePath,
                'updated_at' => Carbon::now()
            ]);


            return redirect()->route('dashboard')->with('flash_message', 'プロフィールを更新しました');
        }
        else
        {
            return redirect()->route('dashboard')->with('flash_message', 'エラーが発生しました');
        }
    }
    public function calendarShow(Request $request)
    {
        $uid = Auth::User()->id;

        $events = DB::table('calendar')
                ->leftJoin('meds','calendar.user_id','=','meds.user_id')
                ->select('calendar.id','calendar.start_date','calendar.end_date','meds.user_id','meds.name','meds.amount','meds.type','meds.type')
                ->where('calendar.user_id','=', $uid)
                ->get();
        
            $session = $request->session()->all();
            return view('medapp.calendar',['events' => $events]);
        
    }

    public function scheduleAddGET()
    {
        return redirect()->route('top');

    }

    public function scheduleAdd(Request $request)
    {
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            'event_name' => 'required|max:32',
        ]);

        //登録処理

        $schedule = new calendar;
        // 日付に変換。JavaScriptのタイムスタンプはミリ秒なので秒に変換
        $schedule->start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $schedule->end_date = date('Y-m-d', $request->input('end_date') / 1000);
        $schedule->event_name = $request->input('event_name');
        $schedule->save();

        return;
    }

    public function getEvents (Request $request){
        $events = array();
        $uid = Auth::User()->id;
        $mymeds = DB::table('calendar')
                ->leftJoin('users','calendar.user_id','=','users.id')
                ->select('calendar.id','users.id', 'calendar.event_name', 'calendar.start_date', 'calendar.end_date')
                ->where('users.id','=',$uid)
                ->get();
        $session = $request->session()->all();

        foreach($mymeds as $event){
            $events[] = [
                'title' => $event->event_name,
                'start' => $event->start_date,
                'end' => $event->end_date,
            ];
            }
        
        return response()->json($events);
    }

    public function addeventGET()
    {
        return redirect()->route('calendar');
    }

    public function addEvent(Request $request)
    {
        $uid = Auth::User()->id;
        $input = $request->all();

        if(!$input){
            $errors[] = "エラーが発生しました。";
            return view('medapp.calendar');
        } else {
            DB::table('calendar')->insert([
                'user_id' => $uid,
                'event_name' => $input['title'],
                'start_date' => $input['start_date'],
                'end_date' => $input['end_date'],
                'created_at' => Carbon::now()
            ]);
        }
        return redirect()->route('calendar');
    }

}
