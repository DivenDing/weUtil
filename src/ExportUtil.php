<?php

namespace Diven\WeUtil;

class ExportUtil
{

    /**
     * 导出CSV文件,统一编码GB2312
     * @param $filename 文件名
     * @param $header 文件列标题
     * @param $data 文件内容
     */
    public static function downCSVFormat($filename, $header, $data)
    {
        foreach ($header as &$head) {
            $head = iconv("UTF-8", "GB2312//IGNORE", $head);
        }
        foreach ($data as &$datum) {
            foreach ($datum as &$datum2) {
                $datum2 =  iconv("UTF-8", "GB2312//IGNORE", $datum2);
            }
        }
        header('Content-Type: text/csv');
        header("Content-Disposition: attachment; filename={$filename}.csv");
        $out = fopen('php://output', 'w');
        fputcsv($out, $header);
        foreach ($data as $line) {
            fputcsv($out, $line);
        }
        fclose($out);
        exit;
    }
}