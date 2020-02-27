<?php

namespace App\Admin\Controllers;

use App\Models\VisitorRegistry;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VisitorRegistryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'log 日志';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VisitorRegistry());

        $grid->column('article.title', __('文章title'));
        $grid->column('ip', __('访问Ip'));
        $grid->column('created_at', __('访问时间'));
        $grid->column('clicks', __('访问次数'));

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
        $show = new Show(VisitorRegistry::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('art_id', __('Art id'));
        $show->field('ip', __('Ip'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('clicks', __('Clicks'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VisitorRegistry());

        $form->number('art_id', __('Art id'));
        $form->ip('ip', __('Ip'));
        $form->number('clicks', __('Clicks'));

        return $form;
    }
}
