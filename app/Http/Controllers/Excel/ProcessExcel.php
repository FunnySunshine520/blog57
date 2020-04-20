<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use Illuminate\Http\Request;
use App\Business\Import\ImportExcel;

use Excel;
use Illuminate\Support\Facades\DB;
define('STORAGE_DIR', __DIR__."/../../../storage");

class ProcessExcel extends Controller
{
    public function processExcel()
    {
//        echo memory_get_usage();die;
        $filePath = STORAGE_DIR.'/import/20200317.xlsx';
        $array = Excel::toArray(new ImportExcel(), $filePath);
        $array = $array[0];
        $fields = [];
        $string = '
            <tr>
                <td align="left">id</td>
                <td align="center">工商id</td>
                <td align="center">string</td>
                <td align="center"></td>
            </tr>';

        foreach ($array as $item) {
            if (!isset($fields[$item[1]])) {
                $fields[$item[1]] = [];
            }
            array_push($fields[$item[1]], $item);
        }
        $textArray = [];
        foreach ($fields as $item) {
            $mdText = '';
            foreach ($item as $api) {
                switch ($api[5]) {
                    case 'keyword':case 'text':case 'date':
                        $type = 'string';
                        break;
                    case 'object':
                        $type = 'object';
                        break;
                    default:
                        $type = $api[5];
                        break;
                }
                $mdText .= '<tr>
                    <td align="left">'. $api[4] .'</td>
                    <td align="center">'. $api[3] .'</td>
                    <td align="center">'. $type .'</td>
                    <td align="center"></td>
                </tr>';
            }
            $textArray[] = $mdText;
        }
        return($textArray);
    }
}
