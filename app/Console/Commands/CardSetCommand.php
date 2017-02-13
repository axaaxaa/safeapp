<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PHPExcel;
use PHPExcel_IOFactory;
use DB;
class CardSetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:card';

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
     * @return mixed
     */
    public function handle()
    {
        //


        define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

// Create new PHPExcel object
        echo date('H:i:s') , " Create new PHPExcel object" , EOL;
        $objPHPExcel = new PHPExcel();

// Set document properties
        echo date('H:i:s') , " Set document properties" , EOL;
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("PHPExcel Test Document")
            ->setSubject("PHPExcel Test Document")
            ->setDescription("Test document for PHPExcel, generated using PHP classes.")
            ->setKeywords("office PHPExcel php")
            ->setCategory("Test result file");
//        for ($i=0; $i<10000; $i++){

        $date = date('y-m-d',time());
        $count = 1;

        while ($count <= 10000){
            $An = 'A'.$count;
            $str = '1'.rand(0,9).rand(0,9).date('m', strtotime($date)).rand(0,9).rand(0,9).date('d', strtotime($date)).rand(0,9).rand(0,9);
            $result = DB::table('card_record')->where('code_id',$str)->first();
            if($result){
                continue;
            }
            dump('正在处理'.$count,$result);
            DB::table('card_record')->insertGetId(['code_id'=>$str]);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($An, $str);
            $count++;
            sleep(0.1);
        }

//        }


// Save Excel 2007 file
        $callStartTime = microtime(true);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("/vagrant/safeapp/public/test.xls");
    }
}
