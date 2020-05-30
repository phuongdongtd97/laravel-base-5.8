<?php


namespace App\TraitHelpers;


trait ConfigTrait
{
  public function getWithdrawStatuses()
  {
    return array_map(function ($status) {
      return $status['id'];
    }, config('voucher.status.withdraws'));
  }

  public function findWithdrawStatusById($id)
  {
    return array_values(array_filter(config('voucher.status.withdraws',[]), function ($status) use ($id) {
        return $status['id'] == $id;
      }))[0] ?? null;
  }


}
