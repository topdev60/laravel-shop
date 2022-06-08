<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Seller\SettingController;
use App\Models\Currency;

class ExRatingCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exrating:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $res_usd = SettingController::get_rates("USD");
        $res_eur = SettingController::get_rates("EUR"); 
        $res_usd = json_decode($res_usd);
        $res_eur = json_decode($res_eur);
        $count = Currency::all()->count();
        if(isset($res_usd->rates) || isset($res_eur->rates)){
            $rates["usd"] = $res_usd->rates;
            $rates["eur"] = $res_eur->rates;   
            if (!$count) {
                foreach ($rates["usd"] as $key => $value) {
                    $currence = new Currency;
                    $currence->currency_id = $key;
                    $currence->usd = $value;
                    $currence->eur = $rates["eur"]->$key;
                    $currence->save();
                }
                return true;
            }else {
                foreach ($rates["usd"] as $key => $value) {
                    Currency::where('currency_id', $key)->update(['usd' => $value, 'eur' => $rates["eur"]->$key]);
                }
                return true;
            }
        }else {
            return false;
        }
    }
}
