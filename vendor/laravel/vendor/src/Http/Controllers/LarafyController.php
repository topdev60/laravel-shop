<?php
namespace Laravel\Larafy\Http\Controllers;
use Amcoders\Check\Everify;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artisan;
use DB;
use Illuminate\Support\Str;
use File;
use Session;

use Amcoders\Lpress\Lphelper;

class LarafyController extends Controller
{

	public function install()
    {


         try {
           DB::select('SHOW TABLES');
          return redirect('/404');
        } catch (\Exception $e) {

        }

        try {
          DB::connection()->getPdo();
          if(DB::connection()->getDatabaseName()){
            return abort(404);
          }else{
            $phpversion = phpversion();
            $mbstring = extension_loaded('mbstring');
            $bcmath = extension_loaded('bcmath');
            $ctype = extension_loaded('ctype');
            $json = extension_loaded('json');
            $openssl = extension_loaded('openssl');
            $pdo = extension_loaded('pdo');
            $tokenizer = extension_loaded('tokenizer');
            $xml = extension_loaded('xml');

            $info = [
                'phpversion' => $phpversion,
                'mbstring' => $mbstring,
                'bcmath' => $bcmath,
                'ctype' => $ctype,
                'json' => $json,
                'openssl' => $openssl,
                'pdo' => $pdo,
                'tokenizer' => $tokenizer,
                'xml' => $xml,
            ];
            return view('Larafy::requirments',compact('info'));
          }
        } catch (\Exception $e) {
            $phpversion = phpversion();
            $mbstring = extension_loaded('mbstring');
            $bcmath = extension_loaded('bcmath');
            $ctype = extension_loaded('ctype');
            $json = extension_loaded('json');
            $openssl = extension_loaded('openssl');
            $pdo = extension_loaded('pdo');
            $tokenizer = extension_loaded('tokenizer');
            $xml = extension_loaded('xml');

            $info = [
                'phpversion' => $phpversion,
                'mbstring' => $mbstring,
                'bcmath' => $bcmath,
                'ctype' => $ctype,
                'json' => $json,
                'openssl' => $openssl,
                'pdo' => $pdo,
                'tokenizer' => $tokenizer,
                'xml' => $xml,
            ];
            return view('Larafy::requirments',compact('info'));
        }


    }

    public function info()
    {

        try {
           DB::select('SHOW TABLES');
          return redirect('/404');
        } catch (\Exception $e) {

            return view('Larafy::info');
        }


    }

    public function send(Request $request)
    {
		//clear
    }


public function check() { 

    try { DB::select('SHOW TABLES'); return "Database Installing"; } catch (\Exception $e) { return false; } 

} 

public function migrate() {

 ini_set('max_execution_time', '0'); \Artisan::call('migrate:fresh'); return "Demo Importing"; 

} 
public function seed(Request $request) {
	testSeed(); 
	return "Congratulations! Your site is ready"; 
} 

public function verify($key) {
	$check = Everify::Check($key);
	if ($check == true) {
		echo "success";
	} else {
		echo Everify::$massage;
	}
}  

public function purchase() { 
	try {
		DB::select('SHOW TABLES');
		return redirect('/404');
	} catch (\Exception $e) {
	}
	return view('Larafy::purchase');
} 

public function purchase_check(Request $request) {
	$this->validate($request, ['purchase_code' => 'required']);
	try {
		$check = \Amcoders\Check\Everify::Check($request->purchase_code);
		if ($check == true) {
			return redirect()->route('install.info');
		} else {
			Session::flash('alert', \Amcoders\Check\Everify::$massage);
			return back();
		}
	} catch (Exception $e) {
		return back();
	}
}

}
