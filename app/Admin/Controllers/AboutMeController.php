<?php

namespace App\Admin\Controllers;

use App\Models\AboutMeModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AboutMeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '关于我';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AboutMeModel());

//        $grid->column('id', __('Id'));
        $grid->column('nickname', __('昵称'));
        $grid->column('description', __('个人签名'));
        $grid->column('make', __('简介'));
        $grid->column('contact_me', __('联系方式'))->image('',$width = 100, $height = 100);
        $grid->column('img_url', __('风景图'))->image('',$width = 300, $height = 300);
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(AboutMeModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nickname', __('Nickname'));
        $show->field('description', __('Description'));
        $show->field('make', __('Make'));
        $show->field('contact_me', __('Contact me'));
        $show->field('img_url', __('Img url'));
//        $show->field('created_at', __('Created at'));
//        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AboutMeModel());

        $form->text('nickname', __('昵称'));
        $form->text('description', __('个人签名'));
        $form->textarea('make', __('个人简介'));
        $form->image('contact_me', __('联系我'))->rules('required');
        $form->image('img_url', __('风景图'))->rules('required');

        return $form;
    }
}
