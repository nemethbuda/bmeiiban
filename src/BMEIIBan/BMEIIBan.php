<?php
namespace Nemethbuda\BMEIIBan;

use Ixudra\Curl\Builder;
use Ixudra\Curl\CurlService;

class BMEIIBan
{
    public function getbanlist(){
      $list = Curl::to('http://net.bme.hu/filter/')->get();
      $list = explode('IDE CSAK A TABLAZAT SORAIT',$list)[1];
      $list = explode(PHP_EOL,$list);
      $banned = collect();
      foreach ($list as $row) {
        if (preg_match('/martos.bme.hu/',$row)) {
          $row = explode('<td>',$row)[1];
          $row = explode(' (',$row)[0];
          $banned->push($row);
        }
      }
      return $banned;
    }
}
