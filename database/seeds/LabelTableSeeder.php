<?php

use Illuminate\Database\Seeder;

class LabelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $labels = [
            [ 'label_name'=>'php','color'=>'#a327d0'],
            [ 'label_name'=>'laravel','color'=>'#f4645f'],
            [ 'label_name'=>'ThinkPHP','color'=>'#72B939'],
            [ 'label_name'=>'Go','color'=>'#368cda'],
            [ 'label_name'=>'Nginx','color'=>'#3f5263'],
            [ 'label_name'=>'前端','color'=>'#16D326'],
            [ 'label_name'=>'vue','color'=>'#4fc08d'],
            [ 'label_name'=>'swoole','color'=>'#8d70cc'],
            [ 'label_name'=>'网络协议','color'=>'#453f52'],
            [ 'label_name'=>'mysql','color'=>'#b79f5b'],
            [ 'label_name'=>'redis','color'=>'#a5673f'],
        ];
        foreach ($labels as $label){
            $this->createLabel($label);
        }
    }

    public function createLabel($data)
    {
       $label =  new \App\Models\Label();
       $label->label_name =$data['label_name'];
       $label->color =$data['color'];
       $label->save();
    }
}
