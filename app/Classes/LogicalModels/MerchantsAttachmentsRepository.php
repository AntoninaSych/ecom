<?php


namespace App\Classes\LogicalModels;


use App\Models\MerchantsAttachments;

class MerchantsAttachmentsRepository
{
    protected $attachments;


    public function getList(int $merchantId)
    {
        $this->attachments = new MerchantsAttachments();
        return $this->attachments->select()->where('merchant_id', $merchantId)->get();
    }
}
