<?php

/**
 * Created by PhpStorm.
 * User: hungnv950
 * Date: 28/03/2017
 * Time: 15:22
 */

namespace app\helpers;


use fproject\components\DbHelper;

class ImportExcelHelper
{
    public static function saveChunks($array, $length, $saveMode)
    {
        $chunkLists = array_chunk($array, $length);
        foreach ($chunkLists as $chunk) {
            DbHelper::batchSave($chunk, [], $saveMode);
        }
    }


    /* @param $array: array of all data[][]
     * @param $length: length to chunk
     * @param $tableName: name of table
     * @param $arrayAttr: attributes of table
     *
     * */
    public static function insertChunks($array, $length, $tableName, $arrayAttr) {
        $chunkLists = array_chunk($array, $length);
        foreach ($chunkLists as $chunk) {
            ImportExcelHelper::cmSave($tableName, $arrayAttr, $chunk);
        }
    }

    /* @var $tableName: name of table to insert $data
     * @var $data:  array of array
     * @var $arrayAttr: attribute of table need insert
     *
     * */
    protected function cmSave($tableName, $arrayAttr, $data) {
        \Yii::$app->db->createCommand()->batchInsert(
            $tableName,
            $arrayAttr,
            $data
            )->execute();
    }

    protected function cmUpdate($tableName, $arrayAttr, $data) {
        \Yii::$app->db->createCommand()
            ->update(
                $tableName,
                $data, //columns and values
                [ 'id' =>$data->id]) //condition, similar to where()
            ->execute();
    }
}