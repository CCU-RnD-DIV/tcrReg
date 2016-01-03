<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->environment(['production'])) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        Validator::extend('pid', function($attribute, $value, $parameters) {

            $map = array(
                'A'=>10,'B'=>11,'C'=>12,'D'=>13,'E'=>14,'F'=>15,
                'G'=>16,'H'=>17,'I'=>34,'J'=>18,'K'=>19,'L'=>20,
                'M'=>21,'N'=>22,'O'=>35,'P'=>23,'Q'=>24,'R'=>25,
                'S'=>26,'T'=>27,'U'=>28,'V'=>29,'W'=>32,'X'=>30,
                'Y'=>31,'Z'=>33
            );
            // ^: 必須以英文開頭
            // $: 必須以數字結尾
            // 先檢查字數可以節省時間
            $value = strtoupper($value);
            if (strlen($value) != 10 || preg_match("/^[A-Z][1-2][0-9]+$/", $value) == 0) return FALSE;

            $code = 0;
            for($i = 0; $i < strlen($value); $i++){
                $symbol = substr($value,$i,1);

                // 英文字母
                if($i == 0){
                    $tmp = $map[$symbol];
                    $code = ($tmp/10)%10 + ($tmp%10)*9;
                    // 最後一碼
                }else if($i == strlen($value) - 1){
                    $code += intval($symbol);
                    // 其他: 乘上 8,7,6,5,4,3,2,1
                }else{
                    $code += intval($symbol) * (9 - $i);
                }
            }

            if($code % 10 == 0){
                return TRUE;
            }else{
                return FALSE;
            }


        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
