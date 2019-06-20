<?php

use App\Models\Cms;
use Illuminate\Database\Seeder;

class CmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $cms = new Cms();
        $cms->name = 'WordPress';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'Joomla';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'Drupal';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'Magento';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'Blogger';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'Shopify';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'TYPO3';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'Bitrix';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'Google Sites';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'ExpressionEngine';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'SilverStripe';
        $cms->save();

        $cms = new Cms();
        $cms->name = 'TextPattern';
        $cms->save();
    }
}
