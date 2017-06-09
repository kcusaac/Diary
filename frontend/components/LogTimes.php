<?php
// class to convert str date to date
namespace app\modules\notes\components;
class LogTimes
{
    public $from;

    public $to;

    public function getTimeFrom($beginTime){

        $this->from = date("H:i", strtotime($beginTime));
        return $this;

    }


    public function getTimeTo($endTime){

        $this->to = date("H:i", strtotime($endTime));
        return $this;

    }

}
