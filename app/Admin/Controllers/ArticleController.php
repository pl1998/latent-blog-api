<?php

namespace App\Admin\Controllers;

use App\Helpers\Translate;
use App\Models\Article;
use App\Models\Category;
use App\Models\Label;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());
        $grid->model()->orderBy('stick', 'desc');
        $grid->model()->orderBy('created_at', 'desc');
        $grid->column('category.name', __('所属分类'));
        $grid->column('admin_user.name', __('所属作者'));
        $grid->column('title', __('文章标题'));
        $grid->column('description', __('描述'));
        $grid->column('review_count', __('评论数'));
        $grid->column('browse_count', __('浏览量'));
        $grid->column('label', __('所属标签'))->display(function ($label){
          $labels =   explode(',',$label);
          $value = "";
          foreach ( $labels as $id ) {
              $label = Label::query()->find($id);
              $value .= sprintf("<span class='btn btn-xs'  style='background-color: %s;color: #f0f0f0'><i class='fa fa-tag'></i>&nbsp;%s</span>&nbsp;&nbsp;",$label->color,$label->label_name);
          }
          return $value;
        });
        $grid->column('status')->using([0 => 'show', 1 => 'hide',], '未知')->dot([0 => 'success', 1 => 'danger',], 'warning');
        $grid->column('created_at', __('创建时间'));

        //数据查询过滤器
        $grid->filter(function ($filter){
            //显示
//            $filter->expand();
            //去掉默认id过滤器
            //$filter->disableIdFilter();
            //


        });

//        $grid->selector(function (Grid\Tools\Selector $selector) {
//            $selector->select('category.name', '分类选择', [
//                1 => '华为',
//                2 => '小米',
//                3 => 'OPPO',
//                4 => 'vivo',
//            ]);
//        });
        $grid->enableHotKeys();
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
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category_id', __('Category id'));
        $show->field('user_id', __('User id'));
        $show->field('title', __('Title'));
        $show->field('cover_img', __('Cover img'));
        $show->field('description', __('Description'));
        $show->field('content', __('Content'));
        $show->field('review_count', __('Review count'));
        $show->field('browse_count', __('Browse count'));
        $show->field('label_id', __('Label id'));
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
        $form = new Form(new Article());

        $form->hidden('user_id')->default(Admin::user()->id);
        $form->select('category_id','所属分类')->options(function (){
            $category_array =   Category::query()
                ->where('is_directory', false)
                ->get();
            $category_name = [];
            foreach ($category_array as $category){
                $category_name[$category->id] = $category->full_name;
            }
            return $category_name;
        })->rules('required');
        $form->multipleSelect('label', __('标签'))->options(function (){
            $labels =    Label::all();
            $label_name = [];
            foreach ($labels as $label){
                $label_name[$label->id] = $label->label_name;
            }
            return $label_name;

        })->rules('required');

        $form->text('title', __('文章标题'))->rules('required');
        $form->image('cover_img', __('文章图片'))->rules('required');
        $form->text('description', __('文章描述'))->rules('required|min:5');
        $form->simplemde('content', __('文章内容'))->rules('required')->height(500);

        //$form->datetime('created_at', __('发布时间'))->rules('required|date');

        $form->switch('status', __('是否公开'))->states([
            'off' => ['value' => 0, 'text' => '公开', 'color' => 'success'],
            'on'  => ['value' => 1, 'text' => '隐藏', 'color' => 'danger'],
        ]);
        $form->switch('stick', __('是否置顶'))->states([
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            'on'  => ['value' => 1, 'text' => '置顶', 'color' => 'success'],
        ]);

        $form->saving(function (Form $form) {
            if($form->status=='off'){

                $form->status = 0;
            }else{
                $form->status = 1;
            }

            if($form->stick=='off'){
                $form->stick = 0;
            }else{
                $form->stick = 1;
            }
           $form->label =  $this->setStick($form->label,$form->stick);

            if (!$form->slug) {
                $translate = new  Translate();
                $form->slug = $translate->translate($form->title);
            }
        });

        return $form;
    }

    public function setStick($label,int $ment)
    {
        $label = array_filter($label);
        $labels =  Label::query()->where('label_name','置顶')->first();


        if(in_array($labels->id,$label)){
            switch ($ment) {
                case 0:
                    $key = array_search($labels->id, $label);
                    $label_array = array_splice($label, $key,1);
                    return $label_array;
                    break;
                case 1:
                    return $label;
                    break;
            }

        }else{
            switch ($ment) {
                case 0:
                    return $label;
                    break;
                case 1:
                    $label[] .=$labels->id;
                    return $label;
                    break;
            }
        }
    }
}
