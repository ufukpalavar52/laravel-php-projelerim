<?php



namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Hour;
use DB;
class Client extends Model
{
    protected $table = "clients";
    public $timestamps = false;
    protected $fillable = [
        'name','last_name','email','tel','app_date', 'hour_id','doctor_id','confirmation','message',
    ];
    
    static function clientList()
    {
        $clients = Client::all();
        return $clients;
    }
    
    static function clientHours($hour_id)
    {
        $hour = Hour::where('id',$hour_id)->first();
        return $hour;
    }
    
    static function clientDoctors($doctor_id) 
    {
         $doctor = User::find($doctor_id);
         return $doctor;
    }
    
    function clientDoctorNameSurname($doctor_id) 
    {
        if($doctor_id == null) {
            return null;
        } else {
            $doctor = User::where('id',$doctor_id)->first();
            return $doctor->name.' '.$doctor->last_name;
        }
    }
    
    
    static function doktorList()
    {
        $doktors = User::where('authorization','0')->get();
        return $doktors;
    }
    
    static function hourList()
    {
        $hours = Hour::all();
        return $hours;
    }
    
    static function futureAppointment()
    {
        $clients = Client::whereRaw('CURDATE() <= app_date')->get();
        return $clients;
    }
    
    static function pastAppointment()
    {
        $clients = Client::whereRaw('CURDATE() > app_date')->get();
        return $clients;
    }
    
    static function pastDoctorAppointment($id)
    {
        
        $clients = Client::where('doctor_id',$id)->whereRaw('CURDATE() > app_date')->get();
        return $clients;
    }
    
    static function showTodayClients($date)
    {
        $clients = Client::where('app_date',$date)->whereRaw('CURDATE() <= app_date')->get();
        
        return $clients;
    }
    
    static function showTodayDoctorClients($date,$id)
    {
        $clients = Client::where('app_date',$date)->where('doctor_id',$id)->whereRaw('CURDATE() <= app_date')->get();
        
        return $clients;
    }
    
    
}
