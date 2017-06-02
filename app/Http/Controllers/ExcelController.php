<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
class ExcelController extends Controller
{
    //excel test guiding by Laravel学院 tutorial
    public function export(){
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        Excel::create(iconv('UTF-8', 'GBK', '学生成绩'),function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->store('xls');
    }

    public function import(){
        $filePath = 'storage/exports/'.iconv('UTF-8', 'GBK', '学生成绩').'.xls';
        Excel::load($filePath, function($reader) {
            $data = $reader->all();
            dd($data);
        });
    }

    public function test(){
        $file = fopen('D:\1', 'r');
        $res = [];
        while(!feof($file)) {
            $row = explode("	", fgets($file));
            $res[] = $row;
        }
        dump($res);
        fclose($file);
    }
}
