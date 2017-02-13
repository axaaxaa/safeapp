<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use DB;


class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('excel');
        $date = date('y-m-d',time());

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
        $count = 1;

        while ($count <= 100000){
            $An = 'A'.$count;
            $str = '1'.rand(0,9).rand(0,9).date('m', strtotime($date)).rand(0,9).rand(0,9).date('d', strtotime($date));
            $result = DB::table('card_record')->where('code_id',$str)->first();
            if($result){
                continue;
            }
            var_dump($result);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($An, $str);
            $count++;
        }

//        }


// Save Excel 2007 file
        $callStartTime = microtime(true);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("/vagrant/safeapp/public/test.xls");
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
