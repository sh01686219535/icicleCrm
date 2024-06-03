<?php

namespace App\Console\Commands;

use App\Mail\InvestorEmail;
use App\Models\Investor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CustomTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
        public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
       $count = Investor::where(function ($query) {
            $query->whereDay('birth_date', '=', date('d'))
                ->whereMonth('birth_date', date('m'));
                

        })
            ->count();
       if($count==1){
        $investor = Investor::where(function ($query) {
            $query->whereMonth('birth_date', date('m'))
            ->whereDay('birth_date', '=', date('d'));

        })
            ->first();
            
     
            $data = ['email' => $investor->email,'name' => $investor->name];
            Mail::send('email.investorBirthMail', $data, function ($message) use ($data) {
                $message->from('icicles47@gmail.com', 'Admin');
                $message->to($data['email'])
                    ->subject('Happy Birthday to You');
            });

       }
       elseif($count>1){
        
        $investors = Investor::where(function ($query) {
            $query->whereMonth('birth_date', date('m'))
            ->whereDay('birth_date', '=', date('d'));
                
                
            

        })
            ->get();
            
       foreach ($investors as $investor) {
           
        $data = ['email' => $investor->email,'name' => $investor->name];
        Mail::send('email.investorBirthMail', $data, function ($message) use ($data) {
                $message->from('icicles47@gmail.com', 'Admin');
                $message->to($data['email'])
                    ->subject('Happy Birthday to You');
            });
       }
        
       }
       else{

       }
       
        $count2 = Investor::where(function ($query) {
                $query->whereMonth('spouse_date_birth', date('m'))
                ->whereDay('spouse_date_birth', '=', date('d'));
                    
    
            })
                ->count();
           if($count2==1){
            $investor = Investor::where(function ($query) {
                $query->whereMonth('spouse_date_birth', date('m'))
                ->whereDay('spouse_date_birth', '=', date('d'));
    
            })
                ->first();
                
         
                $data = ['email' => $investor->email,'spouse_name' => $investor->spouse_name];
                Mail::send('email.investorSpouseMail', $data, function ($message) use ($data) {
                    $message->from('icicles47@gmail.com', 'Admin');
                    $message->to($data['email'])
                        ->subject('Happy Birthday to your BetterHalf');
                });
    
           }
           elseif($count2>1){
            
            $investors = Investor::where(function ($query) {
                $query->whereMonth('spouse_date_birth', date('m'))
                ->whereDay('spouse_date_birth', '=', date('d'));
                    
                    
                
    
            })
                ->get();
                
           foreach ($investors as $investor) {
               
            $data = ['email' => $investor->email,'spouse_name' => $investor->spouse_name];
            Mail::send('email.investorSpouseMail', $data, function ($message) use ($data) {
                    $message->from('icicles47@gmail.com', 'Admin');
                    $message->to($data['email'])
                        ->subject('Happy Birthday to your BetterHalf');
                });
           }
            
           }
           else{
    
           }
           
           
            $count3 = Investor::where(function ($query) {
                $query->whereMonth('marriage', date('m'))
                ->whereDay('marriage', '=', date('d'));
                    
    
            })
                ->count();
           if($count3==1){
            $investor = Investor::where(function ($query) {
                $query->whereMonth('marriage', date('m'))
                ->whereDay('marriage', '=', date('d'));
    
            })
                ->first();
                
         
                $data = ['email' => $investor->email,'name' => $investor->name,'spouse_name' => $investor->spouse_name];
                Mail::send('email.investorMarriageMail', $data, function ($message) use ($data) {
                    $message->from('icicles47@gmail.com', 'Admin');
                    $message->to($data['email'])
                        ->subject('Marriage Day Wish');
                });
    
           }
           elseif($count3>1){
            
            $investors = Investor::where(function ($query) {
                $query->whereMonth('marriage', date('m'))
                ->whereDay('marriage', '=', date('d'));
                    
                    
                
    
            })
                ->get();
                
           foreach ($investors as $investor) {
               
            $data = ['email' => $investor->email,'name' => $investor->name,'spouse_name' => $investor->spouse_name];
            Mail::send('email.investorMarriageMail', $data, function ($message) use ($data) {
                    $message->from('icicles47@gmail.com', 'Admin');
                    $message->to($data['email'])
                        ->subject('Marriage Day Wish');
                });
           }
            
           }
           else{
    
           }
    }
}
