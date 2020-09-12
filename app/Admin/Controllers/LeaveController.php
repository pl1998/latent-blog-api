<?php


namespace App\Admin\Controllers;


use App\Helpers\Translate;
use App\Models\Article;
use App\Models\Label;
use App\Models\LeaveMessageModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class LeaveController extends AdminController
{
    protected $title = '留言列表';

    protected function grid()
    {
        $grid = new Grid(new LeaveMessageModel());
        $grid->column('id','id');
        $grid->column('email','email');
        $grid->column('status','status')->display(function ($status){
           switch ($status){
               case 0:
                   return "<span class='btn btn-success btn-xs'>发送成功</span>";
                   break;
               case 1:
                   return "<span class='btn btn-danger btn-xs'>发送失败</span>";
                   break;
               case 2:
                   return "<span class='btn btn-success btn-xs'>审核通过</span>";
                   break;
               case 3:
                   return "<span class='btn btn-danger btn-xs'>审核失败</span>";
                   break;
           }
        });

        $grid->column('content','留言内容');
        $grid->column('created_at','留言时间');
        $grid->column('url','网址')->url();

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new LeaveMessageModel());

        $form->switch('status', __('审核通过'))->states([
            'off' => ['value' => 2, 'text' => '失败', 'color' => 'danger'],
            'on'  => ['value' => 3, 'text' => '通过', 'color' => 'success'],
        ]);
        $form->saving(function (Form $form) {
            if($form->status=='off'){
                $form->status = 2;
            }else{
                $form->status = 3;
            }
        });

        return $form;
    }

}
