<?php


namespace App\Admin\Extensions\Tools;


use Encore\Admin\Admin;
use Illuminate\Support\Facades\Request;
use Encore\Admin\Grid\Tools\AbstractTool;

class ColorSelectTools extends AbstractTool
{

    protected function script()
    {
        $url = Request::fullUrlWithQuery(['colorSelect' => '_colorSelect_']);

        return <<<EOT
$('input:text.colorSelect').change(function () {
    var url = "$url".replace('_colorSelect_', $(this).val());
    $.pjax({container:'#pjax-container', url: url });

});

EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        $options = [
            'all'   => 'All',
            'm'     => 'Male',
            'f'     => 'Female',
        ];

        return view('admin.tools.color_select_tools', compact('options'));
    }
}
