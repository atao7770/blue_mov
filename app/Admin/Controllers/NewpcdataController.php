<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\Star;
use App\Models\Newpcdata;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\ContextMenuActions;
use Encore\Admin\Show;

class NewpcdataController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Newpcdata';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $movtype = [
            3 => '欧美',
            1 => '亚洲无码',
            9 => '中文字幕',
            8 => '国产',
        ];
        $grid = new Grid(new Newpcdata());
        $grid->column('star')->action(Star::class);
        $grid->column('movname');
//        $grid->column('movurl', __('Movurl'));
        $grid->column('picurl1', __('Picurl1'))->image();
        $grid->column('picurl2', __('Picurl2'))->image();
        $grid->column('picurl3', __('Picurl3'))->image();
        $grid->column('picurl4', __('Picurl4'))->image();
        $grid->column('picurl5', __('Picurl5'))->image();
        $grid->column('torrenturl', __('Torrenturl'))->link();
        $grid->column('type')->editable();
//        $grid->column('downstate')->using(['0' => '未', '1' => '已'])->editable();
        $grid->filter(function($filter) use ($movtype) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            $filter->equal('type')->select($movtype);
            $filter->like('movname','关键字');
        });
//        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->setActionClass(ContextMenuActions::class);
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
        $show = new Show(Newpcdata::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('movname', __('Movname'));
        $show->field('movurl', __('Movurl'));
        $show->field('picurl1', __('Picurl1'));
        $show->field('picurl2', __('Picurl2'));
        $show->field('picurl3', __('Picurl3'));
        $show->field('picurl4', __('Picurl4'));
        $show->field('picurl5', __('Picurl5'));
        $show->field('torrenturl', __('Torrenturl'));
        $show->field('type', __('Type'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Newpcdata());

        $form->text('movname', __('Movname'));
        $form->text('movurl', __('Movurl'));
        $form->text('picurl1', __('Picurl1'));
        $form->text('picurl2', __('Picurl2'));
        $form->text('picurl3', __('Picurl3'));
        $form->text('picurl4', __('Picurl4'));
        $form->text('picurl5', __('Picurl5'));
        $form->text('torrenturl', __('Torrenturl'));
        $form->number('type', __('Type'));

        return $form;
    }
}
