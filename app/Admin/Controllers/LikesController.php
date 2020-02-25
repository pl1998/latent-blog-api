<?php

namespace App\Admin\Controllers;

use App\Models\Likes;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LikesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '友情链接';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Likes());

        $grid->column('name', __('Name'));
        $grid->column('email', __('邮箱'));
        $grid->column('blog_url', __('博客地址'));
        $grid->column('signature', __('签名'));
        $grid->column('created_at', __('添加时间'));
        $grid->column('is_hide')->using([0 => 'hide', 1 => 'show',], '未知')->dot([0 => 'danger', 1 => 'success',], 'warning');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Likes::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('blog_url', __('Blog url'));
        $show->field('signature', __('Signature'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Likes());

        $form->text('name', __('Name'));
        $form->email('email', __('邮箱'))->rules('email');
        $form->text('blog_url', __('Blog url'));
        $form->text('signature', __('签名'));
        $form->textarea('content', __('留言'));
        $form->switch('is_hide', __('是否添加'))->states([
            'off' => ['value' => 0, 'text' => '隐藏', 'color' => 'danger'],
            'on'  => ['value' => 1, 'text' => '显示', 'color' => 'success'],
        ]);

        $form->saving(function (Form $form) {
            if($form->is_hide=='off'){
                $form->status = 1;
            }else{
                $form->is_hide = 0;
            }
        });

        return $form;
    }
}
